<head>
    <title>TrainSkill-กิจกรรมที่ขอเข้าร่วม</title>
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
        <?php if ($searchInput): ?>
            <h2>ผลการค้นหา: <?= htmlspecialchars($searchInput) ?></h2>
        <?php endif; ?>

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
                            <div class="card-body">
                                <h5 class="card-title">ชื่อกิจกรรม: <?= $activity['course_name'] ?></h5>
                                <p class="card-text">ผู้สร้าง: <?= $activity['user_name'] ?></p>
                                <p class="card-text">รายละเอียด: <?= $activity['description'] ?></p>
                                <p class="card-text">จำนวนผู้เข้าร่วม: <?= getNumberParticipants($activity['course_id']); ?>/<?= $activity['max_participants'] ?> คน</p>

                                <?php
                                if ($activity['status'] == 'waiting') {
                                    echo '<button class="btn btn-secondary">สถานะ: ' . $activity['status'] . '</button>';
                                } else if ($activity['status'] == 'accepted') {
                                    echo '<button class="btn btn-success">สถานะ: ' . $activity['status'] . '</button>';
                                } else if ($activity['status'] == 'cancelled') {
                                    echo '<button class="btn btn-danger">สถานะ: ' . $activity['status'] . '</button>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>ไม่พบกิจกรรมที่ตรงกับเงื่อนไข</p>
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