<div class="container mt-4 content">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <?php if (isset($_SESSION['timestamp'])): ?>
                    <?php $courses = $data['courses']; ?>
                    <?php foreach ($courses as $activity): ?>
                        <h2 class="mb-3"><?= $activity['course_name'] ?></h2>
                            <?php
                                $course_id = $activity['course_id'];
                                $courseDetails = getCourseImageTitle($course_id);
                                
                                if ($courseDetails) {
                                    $images = $courseDetails['images'];
                                    
                                    if (!empty($images)) {
                                        echo "<div class='course-images'>";
                                        foreach ($images as $imageURL) {
                                            echo "<img src='$imageURL' class='img-fluid rounded-start' alt='กิจกรรม'>";
                                        }
                                        echo "</div>";
                                    } else {
                                        echo "<p>ไม่มีรูปภาพสำหรับคอร์สนี้</p>";
                                    }
                                } else {
                                    echo "<p>ไม่พบคอร์สที่ตรงกับ course_id นี้</p>";
                                }
                            ?>

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
                        <?php
                            $course_id = $activity['course_id'];
                            $courseDetails = getCourseDetails($course_id);

                            if ($courseDetails) {
                                $images = $courseDetails['images'];
                                
                                // ดึงแค่รูปภาพลำดับที่ 2-4
                                $imagesToShow = array_slice($images, 1, 3); // เริ่มที่ index 1 (ลำดับที่ 2) และแสดง 3 รูป
                                
                                if (!empty($imagesToShow)) {
                                    echo "<div class='course-images'>";
                                    foreach ($imagesToShow as $imageURL) {
                                        echo "<img src='$imageURL' class='img-fluid rounded-start' alt='กิจกรรม'>";
                                    }
                                    echo "</div>";
                                } else {
                                    echo "<p>ไม่มีรูปภาพสำหรับคอร์สนี้</p>";
                                }
                            }
                        ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
