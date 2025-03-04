<head>
    <title>TrainSkill-รายละเอียดกิจกรรม</title>
</head>

<div class="container mt-4 content">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <?php if (isset($_SESSION['timestamp'])): ?>
                    <?php $courses = $data['courses']; ?>
                    <?php foreach ($courses as $activity): ?>
                        <h2 class="mb-3"><?= $activity['course_name'] ?></h2>
                        <!-- ใส่รูปตรงนี้ด้วย หมายถึงในนีแหละ ใส่ต่อจาก h2 เลย -->

                        <p class="mt-3"><strong>👤 ผู้จัดกิจกรรม:</strong> <?= $activity['user_name'] ?></p>
                        <p><strong>📌 รายละเอียด:</strong> <?= $activity['description'] ?></p>
                        <p><strong>👥 จำนวนผู้เข้าร่วม:</strong> กำลังรับสมัคร <?= getNumberParticipants($activity['course_id']); ?>/<?= $activity['max_participants'] ?> คน</p>
                        <p><strong>📅 วันที่จัดกิจกรรม:</strong> <?= $activity['start_date'] ?></p>
                        <p><strong>📅 ถึง:</strong> <?= $activity['end_date'] ?></p>

                        <a href="/course_join?id=<?= $activity['course_id'] ?>" class="btn btn-success mt-3">📢 ฉันเข้าร่วม</a>
                        <a href="/" class="btn btn-secondary mt-3">⬅ Back to Home</a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-flex flex-column gap-3">
                <?php if (isset($_SESSION['timestamp'])): ?>
                    <?php foreach ($courses as $activity): ?>
                        <!-- ใส่รูปตรงนี้ด้วย 3 รูป แต่อาจจะมีการเปลี่ยนวิธีการดึง จากใช้ loop ก็เปลี่ยนเป็นดึงมาเลย -->
                         <!-- ไม่สิ บางทีเราอาจจะใช้ design ใหม่ ใส่รูปที่ด้านล่างของรายละเอี่ยดกิจกรรมไปเลย จะได้ไม่จำกัดรูปภาพ -->
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>