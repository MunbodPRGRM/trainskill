<?php

if (isset($_SESSION['timestamp'])) {
    $courses = $data['courses'];
?>

    <div>
        <?php foreach ($courses as $activity): ?>
            <div>
                <div>
                    <img src="placeholder.png" alt="กิจกรรม">
                </div>
                <div>
                    <h3><?= $activity['course_name'] ?></h3>
                    <p>ผู้สร้าง: <?= $activity['user_name'] ?></p>
                    <p>รายละเอียด: <?= $activity['description'] ?></p>
                    <p>จำกัดจำนวน: <?= $activity['max'] ?> คน</p>
                    <button>รายละเอียด</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php
} else {
?>
    <div class="welcome-section text-center">
        <h1>กรุณาเข้าสู่ระบบ</h1>
    </div>

<?php

}
