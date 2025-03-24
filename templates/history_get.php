<head>
    <title>TrainSkill-กิจกรรมที่ขอเข้าร่วม</title>
    <style>
        .course-images img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            max-height: 150px;
            /* ควบคุมความสูงให้คงที่ */
        }

        .searchbar {
            font-size: 14px;
            font-family: arial, sans-serif;
            color: #202124;
            display: flex;
            z-index: 3;
            height: 44px;
            background: white;
            border: 1px solid #dfe1e5;
            box-shadow: none;
            margin: 0 auto;
            width: auto;
            width: 600px;
        }
    </style>
</head>

<?php
$searchInput = isset($_GET['q']) ? $_GET['q'] : null;
$training = [];

if (isset($_SESSION['timestamp'])) {
    $user_id = $_SESSION['user_id'];

    $result = getTrainingByUserId($user_id);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($searchInput) {
                $isMatch = stripos($row['course_name'], $searchInput) !== false;
                if ($isMatch) {
                    $training[] = $row;
                }
            } else {
                $training[] = $row;
            }
        }
    }
?>

    <div class="container mt-4 content">
        <h1 style="text-align: center;">กิจกรรมที่ขอเข้าร่วม</h1>
        <form class="d-flex mb-4 mt-4">
            <div class="searchbar">
                <div class="searchbar-wrapper">
                    <div class="searchbar-left">
                        <div class="search-icon-wrapper">
                            <span class="search-icon searchbar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="searchbar-center">
                        <div class="searchbar-input-spacer"></div>
                        <input type="search" class="searchbar-input" maxlength="2048" name="q" autocapitalize="off" autocomplete="off" title="Search" role="combobox" placeholder="ชื่อกิจกรรม">
                    </div>
                </div>
                <button class="btn btn-primary" style="width: 90px;">ค้นหา</button>
            </div>
        </form>

        <?php if (!empty($training)): ?>
            <?php foreach ($training as $activity): ?>
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-2 d-flex align-items-center">
                            <?php
                            $course_id = $activity['course_id'];
                            $courseDetails = getCourseImageTitle($course_id);

                            if ($courseDetails) {
                                $images = $courseDetails['images'];

                                if (!empty($images)) {
                                    echo "<div class='course-images'>";
                                    foreach ($images as $imageURL) {
                                        echo "<img src='$imageURL' class='img-fluid rounded-start' alt='กิจกรรม'>";
                                    }
                                    echo "</div>";
                                } else {
                                    echo "<p>ไม่มีรูปภาพสำหรับคอร์สนี้</p>";
                                }
                            } else {
                                echo "<p>ไม่พบคอร์สที่ตรงกับ course_id นี้</p>";
                            }
                            ?>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
                                <!-- รายละเอียดด้านซ้าย -->
                                <div>
                                    <h5 class="card-title">ชื่อกิจกรรม: <?= $activity['course_name'] ?></h5>
                                    <p class="card-text">ผู้สร้าง: <?= $activity['user_name'] ?></p>
                                    <p class="card-text">รายละเอียด: <?= $activity['description'] ?></p>
                                    <p class="card-text">จำนวนผู้เข้าร่วม: <?= getNumberParticipants($activity['course_id']); ?>/<?= $activity['max_participants'] ?> คน</p>
                                    <div>
                                        <a href="/course?id=<?= $activity['course_id'] ?>" class="btn btn-primary">รายละเอียด</a>
                                    </div>
                                </div>



                                <!-- ปุ่มด้านขวา -->
                                <div style="display: flex; flex-direction: column; gap: 8px; align-items: flex-end;">
                                    <div style="display: flex; gap: 8px;">
                                        <?php if ($activity['status'] == 'accepted' && $activity['attendance'] == 'unknown') : ?>
                                            <a href="/checkname?course_id=<?= $activity['course_id'] ?>" class="btn btn-success" style="width: 250px;">เช็กชื่อ</a>
                                        <?php endif; ?>
                                    </div>

                                    <div style="display: flex; gap: 8px;">
                                        <?php
                                        if ($activity['status'] == 'waiting') {
                                            echo '<button class="btn btn-secondary" disabled style="width: 250px;">สถานะ: กำลังรอการตอบรับ</button>';
                                        } else if ($activity['status'] == 'accepted') {
                                            echo '<button class="btn btn-success" disabled style="width: 250px;">สถานะ: เข้าร่วมได้</button>';
                                        } else if ($activity['status'] == 'cancelled') {
                                            echo '<button class="btn btn-danger" disabled style="width: 250px;">สถานะ: ไม่ให้เข้าร่วม</button>';
                                        }
                                        ?>
                                    </div>

                                    <div class="text-center" style="display: flex; gap: 8px;">
                                        <?php
                                        if ($activity['attendance'] == 'present') {
                                            echo '<button class="btn btn-success" disabled style="width: 250px;">เช็กชื่อ: เข้าร่วมกิจกรรม</button>';
                                        } else if ($activity['attendance'] == 'absent') {
                                            echo '<button class="btn btn-danger" disabled style="width: 250px;">เช็กชื่อ: ไม่เข้าร่วมกิจกรรม</button>';
                                        } else {
                                            echo '<button class="btn btn-secondary" disabled style="width: 250px;">เช็กชื่อ: ยังไม่ได้ใส่ OTP</button>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">ไม่พบกิจกรรมที่ตรงกับเงื่อนไข</p>
        <?php endif; ?>
    </div>

<?php
} else {
?>
    <div class="container text-center mt-5">
        <?= header('Location: /login') ?>
    </div>
<?php

}
