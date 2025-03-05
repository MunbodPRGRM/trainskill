<head>
    <title>TrainSkill-แก้ไขกิจกรรม</title>
    <style>
        /* เริ่มต้นสำหรับอุปกรณ์ที่มีหน้าจอขนาดใหญ่ */
        .image-upload-titel {
            height: 350px;
            width: 100%;
            cursor: pointer;
        }
        .image-upload {
            height: 220px;
            width: 100%;
            cursor: pointer;
        }

        /* ปรับขนาดสำหรับอุปกรณ์มือถือ */
        @media (max-width: 768px) {
            .image-upload {
                height: 150px; /* ปรับให้เหมาะสมในมือถือ */
                width: 100%;
                cursor: pointer;
            }
            .image-upload-titel {
                height: 150px;
                width: 100%;
                cursor: pointer;
            }
        }
        #description {
            resize: none; /* ห้ามปรับขนาด */
        }
    </style>
</head>

<?php

$course = $data['course'];
$activity = $course->fetch_assoc();
$course_id = $activity['course_id'];
$courseDetails = getCourseDetails($course_id);
$images = $courseDetails ? $courseDetails['images'] : [];

?>

<div class="container mt-4 content">
    <div class="card p-4">
        <form action="/course_edit" method="post">
            <div class="row">
                <input type="hidden" name="course_id" value="<?= $activity['course_id'] ?>">
                <!-- อัปโหลดรูปหลัก -->
                <div class="col-12 col-md-6 d-flex align-items-center justify-content-center mb-3 mb-md-0">
                    <label for="image1" class="border d-flex align-items-center justify-content-center bg-dark text-light image-upload-titel">
                        <?php
                            if (!empty($images)) {
                                echo "<div class='course-images'>";
                                echo "<img src='{$images[0]}' class='img-fluid rounded-start' alt='กิจกรรม'>";
                                echo "</div>";
                            } else {
                                echo "<p>ไม่มีรูปภาพสำหรับคอร์สนี้</p>";
                            }
                        ?>
                    </label>
                    <input type="file" id="image1" name="image1" class="d-none">
                </div>

                <div class="col-12 col-md-6">
                    <div class="mb-2">
                        <label for="name" class="form-label">ชื่อกิจกรรม</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?= $activity['course_name'] ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
                        <textarea type="text" id="description" name="description" class="form-control" style="height: 100px;" required><?= $activity['description'] ?></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="max_participants" class="form-label">จำนวนคนสูงสุด</label>
                        <input type="number" id="max_participants" name="max_participants" class="form-control" value="<?= $activity['max_participants'] ?>" required>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="d-flex flex-column flex-md-row">
                            <div class="mb-2 me-md-2 flex-fill">
                                <label for="start_date" class="form-label">วันที่เริ่ม</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" value="<?= $activity['start_date'] ?>" required>
                            </div>
                            <div class="mb-2 flex-fill">
                                <label for="end_date" class="form-label">วันที่สิ้นสุด</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" value="<?= $activity['end_date'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- อัปโหลดรูปเพิ่มเติม -->
            <div class="row mt-3">
                <div class="col-12 col-md-4">
                    <label for="image2" class="border d-flex align-items-center justify-content-center bg-dark text-light image-upload">
                        <?php
                            if (isset($images[1])) {
                                echo "<img src='{$images[1]}' class='img-fluid' alt='รูปที่ 2'>";
                            }
                        ?>
                    </label>
                    <input type="file" id="image2" name="image2" class="d-none">
                </div>
                <div class="col-12 col-md-4">
                    <label for="image3" class="border d-flex align-items-center justify-content-center bg-dark text-light image-upload">
                        <?php
                            if (isset($images[2])) {
                                echo "<img src='{$images[2]}' class='img-fluid' alt='รูปที่ 3'>";
                            }
                        ?>
                    </label>
                    <input type="file" id="image3" name="image3" class="d-none">
                </div>
                <div class="col-12 col-md-4">
                    <label for="image4" class="border d-flex align-items-center justify-content-center bg-dark text-light image-upload">
                        <?php
                            if (isset($images[3])) {
                                echo "<img src='{$images[3]}' class='img-fluid' alt='รูปที่ 4'>";
                            }
                        ?>
                    </label>
                    <input type="file" id="image4" name="image4" class="d-none">
                </div>
            </div>

            <div class="mt-4 text-center">
                <input type="submit" class="btn btn-success w-50" value="บันทึกการแก้ไข"></input>
            </div>
        </form>
    </div>
</div>
