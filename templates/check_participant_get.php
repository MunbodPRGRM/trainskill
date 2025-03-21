<?php

$training = $data['training'];

foreach ($training as $activity) {
    $course_name = $activity['course_name'];
}

?>

<div class="container mt-4 content">
    <div class="card p-4">
        <h3 class="mb-3">เช็กชื่อผู้มาเข้าร่วมกิจกรรม <?= $course_name ?></h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>UserID</th>
                        <th>ชื่อ</th>
                        <th>อีเมล</th>
                        <th>เพศ</th>
                        <th>อายุ</th>
                        <th>สถานะ</th>
                        <th>รหัส OTP</th>
                        <th>ส่ง OTP</th>
                        <th>จัดการฉุกเฉิน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($training as $activity): ?>
                        <?php if ($activity['status'] == 'accepted') { ?>
                            <tr>
                                <td><?= $activity['user_id'] ?></td>
                                <td><?= $activity['user_name'] ?></td>
                                <td><?= $activity['email'] ?></td>
                                <td><?= $activity['gender'] ?></td>
                                <td><?= (new DateTime())->diff(new DateTime($activity['birthday']))->y . " ปี"; ?></td>

                                <?php
                                    if ($activity['attendance'] == 'present') {
                                        echo '<td>มาเข้าร่วมกิจกรรม</td>';
                                    } else if ($activity['attendance'] == 'absent') {
                                        echo '<td>ไม่มาเข้าร่วมกิจกรรม</td>';
                                    } else {
                                        echo '<td>ส่ง OTP ไปแล้ว</td>';
                                    }
                                ?>

                                <?php if ($activity['otp'] != null): ?>
                                    <td><?= $activity['otp'] ?></td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>

                                <td class="text-center">
                                <a href="/check_participant?user_id=<?= $activity['user_id'] ?>&course_id=<?= $activity['course_id'] ?>&btOTP=1" class="btn btn-success btn-sm">ส่งรหัส</a>
                                    <a href="/check_participant?user_id=<?= $activity['user_id'] ?>&course_id=<?= $activity['course_id'] ?>&btOTP=2" class="btn btn-danger btn-sm">ยกเลิก</a>
                                </td>
                                
                                <td class="text-center">
                                    <a href="/check_participant?user_id=<?= $activity['user_id'] ?>&course_id=<?= $activity['course_id'] ?>&bt=1" class="btn btn-success btn-sm">มา</a>
                                    <a href="/check_participant?user_id=<?= $activity['user_id'] ?>&course_id=<?= $activity['course_id'] ?>&bt=2&btOTP=2" class="btn btn-danger btn-sm">ไม่มา</a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>