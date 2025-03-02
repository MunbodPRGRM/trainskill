<head>
    <title>TrainSkill-กิจกรรมที่ขอเข้าร่วม</title>
</head>
<?php

if (isset($_SESSION['timestamp'])) {
    $training = $data['training'];
?>
    <div class="container mt-4 content">
        <h1 style="text-align: center;">กิจกรรมที่ขอเข้าร่วม</h1>
        <?php foreach ($training as $activity): ?>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-2 d-flex align-items-center">
                        <?php
                        $imageData = base64_encode($activity['image1']);
                        echo '<img src="data:image/jpeg;base64,' . $imageData . '" class="img-fluid rounded-start" alt="กิจกรรม">';
                        ?>
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h5 class="card-title">ชื่อกิจกรรม: <?= $activity['course_name'] ?></h5>
                            <p class="card-text">ผู้สร้าง: <?= $activity['user_name'] ?></p>
                            <p class="card-text">รายละเอียด: <?= $activity['description'] ?></p>
                            <p class="card-text">จำกัดจำนวน: <?= $activity['max'] ?> คน</p>

                            <?php
                            if ($activity['status'] == 'waiting') {
                                echo '<button class="btn btn-secondary">สถานะ: ' .  $activity['status']  . '</button>';
                            } else if ($activity['status'] == 'completed') {
                                echo '<button class="btn btn-success">สถานะ: ' .  $activity['status']  . '</button>';
                            } else if ($activity['status'] == 'cancelled') {
                                echo '<button class="btn btn-danger">สถานะ: ' .  $activity['status']  . '</button>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php
} else {
?>
    <div class="container text-center mt-5">
        <?= header('Location: /login') ?>
    </div>
<?php

}
