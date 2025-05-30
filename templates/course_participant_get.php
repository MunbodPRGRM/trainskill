<?php

$training = $data['training'];

foreach ($training as $activity) {
    $course_name = $activity['course_name'];
    $course_id = $activity['course_id'];
}

?>

<div class="container mt-4 content">
    <div class="card p-4">
        <?php if (isset($course_name) && isset($course_id)) { ?>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">รายชื่อผู้มาเข้าร่วมกิจกรรม <?= $course_name ?></h3>
                <div>
                    <a href="/check_participant?course_id=<?= $course_id ?>" class="btn btn-primary">
                        <i class="fas fa-user-check"></i> เช็กชื่อผู้มาเข้าร่วมกิจกรรม
                    </a>
                    <a href="/course_statistic?course_id=<?= $course_id ?>" class="btn btn-info">
                        ดูสถิติการเข้าร่วม
                    </a>
                    <a href="/course_own" class="btn btn-secondary">
                        <i class="fas fa-user-check"></i> ย้อนกลับ
                    </a>
                </div>
            </div>
            <p class="card-text">ผู้ที่่เข้าร่วมได้: <?= getNumberParticipants($activity['course_id']); ?>/<?= $activity['max_participants'] ?> คน</p>
        <?php } else { ?>
            <h3 class="mb-3">ยังไม่มีผู้ขอเข้าร่วมกับกิจกรรมของคุณ</h3>
        <?php } ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>UserID</th>
                        <th>ชื่อ</th>
                        <th>อีเมล</th>
                        <th>เพศ</th>
                        <th>อายุ</th>
                        <th>สถานะ</th>
                        <th class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($training as $activity): ?>
                        <tr>
                            <td><?= $activity['user_id'] ?></td>
                            <td><?= $activity['user_name'] ?></td>
                            <td><?= $activity['email'] ?></td>
                            <td><?= $activity['gender'] ?></td>
                            <td><?= (new DateTime())->diff(new DateTime($activity['birthday']))->y . " ปี"; ?></td>

                            <?php
                            if ($activity['status'] == 'accepted') {
                                echo '<td>ยอมรับการเข้าร่วม</td>';
                            } else if ($activity['status'] == 'waiting') {
                                echo '<td>รอการตอบรับ</td>';
                            } else if ($activity['status'] == 'cancelled') {
                                echo '<td>ปฏิเสธการเข้าร่วม</td>';
                            } else {
                                echo '<td></td>';
                            }
                            ?>

                            <td class="text-center">
                                <?php if ($activity['status'] == 'accepted' || $activity['status'] == 'cancelled') { ?>
                                    <a href="/course_response?user_id=<?= $activity['user_id'] ?>&course_id=<?= $activity['course_id'] ?>&status=<?= $activity['status'] ?>&bt=0" class="btn btn-warning btn-sm" onclick="return confirmAlright()">ยกเลิก</a>
                                <?php } else { ?>
                                    <?php if (getNumberParticipants($activity['course_id']) === $activity['max_participants']): ?>
                                        <button class="btn btn-success btn-sm" disabled>ยอมรับ</button>
                                        <button class="btn btn-danger btn-sm" disabled>ปฏิเสธ</button>
                                    <?php else: ?>
                                        <a href="/course_response?user_id=<?= $activity['user_id'] ?>&course_id=<?= $activity['course_id'] ?>&status=<?= $activity['status'] ?>&bt=1" class="btn btn-success btn-sm" onclick="return confirmAlright()">ยอมรับ</a>
                                        <a href="/course_response?user_id=<?= $activity['user_id'] ?>&course_id=<?= $activity['course_id'] ?>&status=<?= $activity['status'] ?>&bt=2" class="btn btn-danger btn-sm" onclick="return confirmReject()">ปฏิเสธ</a>
                                    <?php endif; ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>