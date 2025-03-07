<?php

$training = $data['training'];

foreach ($training as $activity) {
    $course_name = $activity['course_name'];
}

?>

<div class="container mt-4 content">
    <div class="card p-4">
        <h3 class="mb-3">เช็กชื่อผู้มาเข้าร่วมกิจกรรม <?=$course_name?></h3>
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
                            <td><?= $activity['attendance'] ?></td>
                            <td class="text-center">
                            <a href="/check_participant?user_id=<?= $activity['user_id'] ?>&course_id=<?= $activity['course_id'] ?>&bt=1" class="btn btn-success btn-sm">มาร่วมกิจกรรม</a>
                            <a href="/check_participant?user_id=<?= $activity['user_id'] ?>&course_id=<?= $activity['course_id'] ?>&bt=2" class="btn btn-danger btn-sm">ไม่มากิจกรรม</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>