<?php
$course = $data['course'];
?>

<div class="container mt-4 content">
    <form action="/checkname" method="post">
        <div class="container d-flex justify-content-center align-items-center mt-3">
            <div class="card shadow-lg p-5" style="max-width: 600px; width: 100%;">
                <div class="text-center">
                    <h4>ใส่รหัส OTP เพื่อเช็กชื่อ</h4>
                </div>
                <hr>
                <div class="mt-1">
                    <div class="text-center mb-4">
                        <p style="color: red;">***รหัส OTP อยู่ที่หน้าการแจ้งเตือน โปรดรอให้ผู้สร้างกิจกรรมส่งรหัสให้***</p>
                    </div>
                    <div class="mb-4">
                        <?php foreach ($course as $activity): ?>
                            <p>ชื่อกิจกรรม: <?= $activity['course_name'] ?></p>
                            <p>ผู้สร้าง: <?= $activity['user_name'] ?></p>
                        <?php endforeach; ?>
                    </div>
                    <div>
                        <div class="mb-3">
                            <input type="hidden" name="course_id" value="<?= $activity['course_id'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="otp" class="form-label">รหัส OTP</label>
                            <input type="text" class="form-control" id="otp" name="otp" required>
                        </div>
                        <div class="text-center mt-4 mb-4">
                            <button type="submit" class="btn btn-primary">ยืนยัน</button>
                        </div>
                        <div class="text-center">
                            <?php 
                            if (isset($_SESSION['message'])) {
                                $message = $_SESSION['message'];
                                echo '<p style="color: red">' . $message . '</p>';
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>