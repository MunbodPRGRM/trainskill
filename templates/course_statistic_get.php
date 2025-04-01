<?php
$course_id = $_GET['course_id'] ?? 0;
$conn = getConnection();

// ดึงข้อมูลสถิติ
$stmt = $conn->prepare("
    SELECT 
        u.gender, 
        TIMESTAMPDIFF(YEAR, u.birthday, CURDATE()) AS age,
        t.attendance
    FROM registration r
    JOIN users u ON r.user_id = u.user_id
    JOIN training t ON r.registration_id = t.registration_id
    WHERE r.course_id = ?
");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

$genderStats = ['male' => 0, 'female' => 0, 'unknown' => 0];
$ageGroups = ['<18' => 0, '18-24' => 0, '25-34' => 0, '35-44' => 0, '45+' => 0];
$attendanceStats = ['present' => 0, 'absent' => 0, 'unknown' => 0];
$totalParticipants = 0;

while ($row = $result->fetch_assoc()) {
    // เพศ
    $genderStats[$row['gender']]++;

    // อายุ
    $age = $row['age'];
    if ($age < 18) {
        $ageGroups['<18']++;
    } elseif ($age < 25) {
        $ageGroups['18-24']++;
    } elseif ($age < 35) {
        $ageGroups['25-34']++;
    } elseif ($age < 45) {
        $ageGroups['35-44']++;
    } else {
        $ageGroups['45+']++;
    }

    // สถานะการเข้าร่วม
    $attendanceStats[$row['attendance']]++;

    // จำนวนผู้เข้าร่วมทั้งหมด
    $totalParticipants++;
}

// อัตราการเข้าร่วมและอัตราการปฏิเสธ
$attendanceRate = $totalParticipants > 0 ? round(($attendanceStats['present'] / $totalParticipants) * 100, 2) : 0;
$absentRate = $totalParticipants > 0 ? round(($attendanceStats['absent'] / $totalParticipants) * 100, 2) : 0;
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-4">📊 สถิติการเข้าร่วมกิจกรรม</h2>
        <a href="/course_participant?id=<?= $course_id ?>" class="btn btn-secondary">ย้อนกลับ</a>
    </div>

    <div class="alert alert-info">
        จำนวนผู้ลงทะเบียนทั้งหมด: <strong><?= $totalParticipants ?> คน</strong>
    </div>

    <div class="row">
        <!-- เพศ -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    เพศ
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">👨‍💼 ชาย: <?= $genderStats['male'] ?> คน</li>
                        <li class="list-group-item">👩‍💼 หญิง: <?= $genderStats['female'] ?> คน</li>
                        <li class="list-group-item">❓ ไม่ระบุ: <?= $genderStats['unknown'] ?> คน</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- อายุ -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    อายุ
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">👶 น้อยกว่า 18 ปี: <?= $ageGroups['<18'] ?> คน</li>
                        <li class="list-group-item">🧑 18-24 ปี: <?= $ageGroups['18-24'] ?> คน</li>
                        <li class="list-group-item">🧑‍💼 25-34 ปี: <?= $ageGroups['25-34'] ?> คน</li>
                        <li class="list-group-item">👨‍🦳 35-44 ปี: <?= $ageGroups['35-44'] ?> คน</li>
                        <li class="list-group-item">👴 45 ปีขึ้นไป: <?= $ageGroups['45+'] ?> คน</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- สถานะการเข้าร่วม -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    สถานะการเข้าร่วม
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">✅ เข้าร่วม: <?= $attendanceStats['present'] ?> คน</li>
                        <li class="list-group-item">❌ ขาด: <?= $attendanceStats['absent'] ?> คน</li>
                        <li class="list-group-item">❓ ไม่ระบุ: <?= $attendanceStats['unknown'] ?> คน</li>
                    </ul>
                </div>
                <div class="card-footer">
                    อัตราการเข้าร่วม: <span class="badge bg-success"><?= $attendanceRate ?>%</span>
                    อัตราการขาด: <span class="badge bg-danger"><?= $absentRate ?>%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styling เพิ่มเติม -->
<style>
    .card {
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        font-size: 18px;
        font-weight: bold;
    }

    h2 {
        color: #0d6efd;
        font-weight: bold;
    }

    .badge {
        font-size: 14px;
        padding: 5px 10px;
    }
</style>
