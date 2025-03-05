<?php
$searchInput = isset($_GET['q']) ? $_GET['q'] : null;
$courses = [];

if ($searchInput) {

    $result = searchCoursesWithSingleInput($searchInput);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
    }
} else {
    $courses = $data['courses'];
}

if (isset($_SESSION['timestamp'])) {
?>

    <head>
        <title>TrainSkill</title>
    </head>
    
    <div class="container mt-4">
            <?php if ($searchInput): ?>
                <h1>ผลการค้นหา: <?= htmlspecialchars($searchInput) ?></h1>
            <?php endif; ?>

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
                                            echo "<img src='$imageURL' class='img-fluid rounded-start' alt='กิจกรรม'>";
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
                                    <p class="card-text">วันจัดกิจกรรม: <?= $activity['start_date'] ?> ถึง <?= $activity['end_date'] ?></p>
                                    <a href="/course?id=<?= $activity['course_id'] ?>" class="btn btn-primary">รายละเอียด</a>
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
    <?php
        header('Location: /login');
        exit;
    ?>
<?php

}