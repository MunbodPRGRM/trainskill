<head>
    <title>TrainSkill-แก้ไขกิจกรรม</title>
</head>

<?php

$course = $data['course'];
$activity = $course->fetch_assoc();

$imageData1 = base64_encode($activity['image1']);
$imageData2 = base64_encode($activity['image2']);
$imageData3 = base64_encode($activity['image3']);
$imageData4 = base64_encode($activity['image4']);

?>

<div class="container mt-4 content">
    <div class="card p-4">
        <form action="/course_edit" method="post">
            <div class="row">
                <input type="hidden" name="course_id" value="<?= $activity['course_id'] ?>">
                <!-- อัปโหลดรูปหลัก -->
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <label for="image1" class="border d-flex align-items-center justify-content-center bg-dark" style="cursor: pointer;">
                        <?php echo '<img src="data:image/jpeg;base64,' . $imageData1 . '" class="img-fluid" alt="กิจกรรม">'; ?>
                    </label>
                    <input type="file" id="image1" name="image1" class="d-none">
                </div>

                <div class="col-md-8">
                    <div class="mb-2">
                        <label for="name" class="form-label">ชื่อกิจกรรม</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?= $activity['course_name'] ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
                        <input type="text" id="description" name="description" class="form-control" value="<?= $activity['description'] ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="max" class="form-label">จำนวนคนสูงสุด</label>
                        <input type="number" id="max" name="max" class="form-control" value="<?= $activity['max'] ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="start_date" class="form-label">วันที่เริ่ม</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="<?= $activity['start_date'] ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="end_date" class="form-label">วันที่สิ้นสุด</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="<?= $activity['end_date'] ?>" required>
                    </div>
                </div>
            </div>

            <!-- อัปโหลดรูปเพิ่มเติม -->
            <div class="row mt-5">
                <div class="col-md-4">
                    <label for="image2" class="border d-flex align-items-center justify-content-center bg-dark" style="cursor: pointer;">
                        <?php echo '<img src="data:image/jpeg;base64,' . $imageData2 . '" class="img-fluid" alt="กิจกรรม">'; ?>
                    </label>
                    <input type="file" id="image2" name="image2" class="d-none">
                </div>
                <div class="col-md-4">
                    <label for="image3" class="border d-flex align-items-center justify-content-center bg-dark" style="cursor: pointer;">
                        <?php echo '<img src="data:image/jpeg;base64,' . $imageData3 . '" class="img-fluid" alt="กิจกรรม">'; ?>
                    </label>
                    <input type="file" id="image3" name="image3" class="d-none">
                </div>
                <div class="col-md-4">
                    <label for="image4" class="border d-flex align-items-center justify-content-center bg-dark" style="cursor: pointer;">
                        <?php echo '<img src="data:image/jpeg;base64,' . $imageData4 . '" class="img-fluid" alt="กิจกรรม">'; ?>
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