<?php

$training = $data['training'];

?>

<div class="container mt-4 content">
    <div class="card p-4">
        <h3 class="mb-3">รายชื่อผู้เข้าร่วมกิจกรรม</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ชื่อกิจกรรม</th>
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
                            <td><?= $activity['course_name'] ?></td>
                            <td><?= $activity['user_id'] ?></td>
                            <td><?= $activity['user_name'] ?></td>
                            <td><?= $activity['email'] ?></td>
                            <td><?= $activity['gender'] ?></td>
                            <td><?= (new DateTime())->diff(new DateTime($activity['birthday']))->y . " ปี"; ?></td>
                            <td><?= $activity['status'] ?></td>
                            <td class="text-center">
                                <?php if ($activity['status'] == 'completed' || $activity['status'] == 'cancelled') { ?>
                                    <p>จัดการเสร็จสิ้น</p>
                                <?php } else { ?>
                                    <a href="" class="btn btn-success btn-sm" onclick="return confirmAlright()">ยอมรับ</a>
                                    <a href="" class="btn btn-danger btn-sm" onclick="return confirmReject()">ปฏิเสธ</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>