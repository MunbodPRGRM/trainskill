<head>
    <title>TrainSkill-กิจกรรมของคุณ</title>
    <style>
        .course-images img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            max-height: 150px; /* ควบคุมความสูงให้คงที่ */
        }
    </style>
</head>
<?php
$searchInput = isset($_GET['q']) ? $_GET['q'] : null;
$courses = [];

if (isset($_SESSION['timestamp'])) {
    $user_id = $_SESSION['user_id'];

    if ($searchInput) {
        $result = searchCoursesWithSingleInput($searchInput);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['user_id'] == $user_id) {
                    $courses[] = $row;
                }
            }
        }
    } else {
        $courses = getCourseByUserId($user_id);
    }
?>
    <div class="container mt-4 content">
        <form class="d-flex mb-4">
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
                            <input type="search" class="searchbar-input" maxlength="2048" name="q" autocapitalize="off" autocomplete="off" title="Search" role="combobox" placeholder="ชื่อกิจกรรม/วัน">
                        </div>
                    </div>
                <button class="btn btn-primary" style="border-radius: 20px; width: 90px;">ค้นหา</button>
            </div>
        </form>

        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $activity): ?>
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
                                            echo "<img src='$imageURL' class='img-fluid rounded-start course-images' alt='กิจกรรม'>";
                                        }
                                        echo "</div>";
                                    } else {
                                        echo "<p>ไม่มีรูปภาพสำหรับคอร์สนี้</p>";
                                    }
                                } else {
                                echo "<p>ไม่พบคอร์สที่ตรงกับ course_id นี้</p>";
                            }?>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title">ชื่อกิจกรรม: <?= $activity['course_name'] ?></h5>
                                <p class="card-text">ผู้สร้าง: <?= $activity['user_name'] ?></p>
                                <p class="card-text">รายละเอียด: <?= $activity['description'] ?></p>
                                <p class="card-text">จำนวนผู้เข้าร่วม: <?= getNumberParticipants($activity['course_id']); ?>/<?= $activity['max_participants'] ?> คน</p>
                                <a href="/course_participant?id=<?= $activity['course_id'] ?>" class="btn btn-info">ดูผู้เข้าร่วม</a>
                                <a href="/course_edit?id=<?= $activity['course_id'] ?>" class="btn btn-primary">แก้ไข</a>
                                <a href="/course_delete?id=<?= $activity['course_id'] ?>" class="btn btn-danger" onclick="return confirmDelete()">ลบ</a>
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