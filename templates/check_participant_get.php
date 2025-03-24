<?php

$training = $data['training'];

foreach ($training as $activity) {
    $course_name = $activity['course_name'];
    $course_id = $activity['course_id'];
}

?>

<div class="container mt-4 content">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-3">เช็กชื่อผู้มาเข้าร่วมกิจกรรม <?= $course_name ?></h3>
            <a href="/course_participant?id=<?= $course_id ?>" class="btn btn-secondary">
                <i class="fas fa-user-check"></i> ย้อนกลับ
            </a>
        </div>
        <p style="color: red;">***หากกดส่งรหัส OTP ไปให้ผู้ที่มาเข้าร่วมแล้ว รหัสจะอยู่ที่หน้าการแจ้งเตือนของผู้เข้าร่วม***</p>
        <p style="color: red;">***ยังไม่ได้กำหนดการหมดเวลาของ OTP ดังนั้นหากส่งรหัสไปแล้วผู้เข้าร่วมไม่ได้ใส่รหัส ให้กดไม่มาที่จัดการฉุกเฉิน***</p>
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
                                    <?php if (isset($activity['otp'])): ?>
                                        <button class="btn btn-success btn-sm" disabled>ส่งรหัส</button>
                                    <?php else: ?>
                                        <a href="/check_participant?user_id=<?= $activity['user_id'] ?>&course_id=<?= $activity['course_id'] ?>&btOTP=1" class="btn btn-success btn-sm">ส่งรหัส</a>
                                    <?php endif; ?>

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