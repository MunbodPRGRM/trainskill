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
                        <img src="data:image/jpeg;base64,<?= base64_encode($activity['image1']) ?>" class="img-fluid rounded" alt="กิจกรรม">

                        <p class="mt-3"><strong>👤 ผู้จัดกิจกรรม:</strong> <?= $activity['user_name'] ?></p>
                        <p><strong>📌 รายละเอียด:</strong> <?= $activity['description'] ?></p>
                        <p><strong>👥 จำนวนผู้เข้าร่วม:</strong> กำลังรับสมัคร <?= $activity['max'] ?> คน</p>
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
                        <img src="data:image/jpeg;base64,<?= base64_encode($activity['image2']) ?>" class="img-fluid rounded shadow" alt="กิจกรรม">
                        <img src="data:image/jpeg;base64,<?= base64_encode($activity['image3']) ?>" class="img-fluid rounded shadow" alt="กิจกรรม">
                        <img src="data:image/jpeg;base64,<?= base64_encode($activity['image4']) ?>" class="img-fluid rounded shadow" alt="กิจกรรม">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>