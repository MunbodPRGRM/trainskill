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
                <h1 style="text-align: center;">การแจ้งเตือน</h1>
                <?php if (!empty($training)): ?>
                        <?php foreach ($training as $activity): ?>
                                <?php if ($activity['otp'] != null): ?>
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
                                                                        <p>รหัส OTP: <?= $activity['otp'] ?></p>
                                                                        <?php if ($activity['status'] == 'accepted' && $activity['attendance'] == 'unknown') : ?>
                                                                                <p class="card-text">รายละเอียด: ใส่รหัส OTP เพื่อยืนยันตัวตนที่หน้าประวัติการเข้าร่วม หรือกดปุ่มที่หน้านี้ได้เลย</p>
                                                                                <a href="/checkname?course_id=<?= $activity['course_id'] ?>" class="btn btn-success">เช็กชื่อ</a>
                                                                        <?php else: ?>
                                                                                <p class="card-text">รายละเอียด: ยืนยันตัวตนเรียบร้อย เช็กชื่อสำเร็จ</p>
                                                                        <?php endif; ?>
                                                                </div>
                                                        </div>

                                                </div>
                                        </div>
                                <?php endif; ?>
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
