<head>
    <title>TrainSkill-แก้ไขกิจกรรม</title>
    <style>
        .image-upload-titel,
        .image-upload {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #ddd;
            /* ให้มีสีพื้นหลัง */
        }

        .image-upload-titel img,
        .image-upload img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-upload-titel {
            min-height: 344px;
            /* ควบคุมขนาด */
            max-height: 344px;
            width: 644px;
        }

        .image-upload {
            min-height: 225.5px;
            max-height: 225.5px;
        }

        /* สำหรับมือถือ */
        @media (max-width: 766px) {

            .image-upload-titel,
            .image-upload {
                min-height: 150px;
                max-height: 150px;
            }
        }

        @media (min-width: 767px) and (max-width: 768px) {
            .image-upload-titel {
                min-height: 300px;
                max-height: 300px;
            }

            .image-upload {
                min-height: 150px;
                max-height: 150px;
            }
        }

        #description {
            resize: none;
            /* ห้ามปรับขนาด */
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
        <form action="/course_edit" method="post" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" name="course_id" value="<?= $activity['course_id'] ?>">
                <!-- อัปโหลดรูปหลัก -->
                <div class="col-12 col-md-6 d-flex align-items-center justify-content-center mb-3 mb-md-0">
                    <label for="image1" class="border d-flex align-items-center justify-content-center bg-dark text-light image-upload-titel">
                        <img id="preview-image1" class="w-100 h-100 object-fit-cover <?= empty($images[1]) ? 'd-none' : '' ?>"
                            src="<?= ($images[1]) ?>"
                            alt="กิจกรรม">
                    </label>
                    <input type="file" id="image1" name="image1" class="d-none" onchange="previewImage(this, 'preview-image1')">
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
                <?php for ($i = 2; $i <= 4; $i++) { ?>
                    <div class="col-12 col-md-4">
                        <label for="image<?= $i ?>" class="border d-flex align-items-center justify-content-center bg-dark text-light image-upload">
                            <img id="preview-image<?= $i ?>" class="w-100 h-100 object-fit-cover <?= empty($images[$i]) ? 'd-none' : '' ?>"
                                src="<?= $images[$i] ?>"
                                alt="รูปที่ <?= $i ?>">
                        </label>
                        <input type="file" id="image<?= $i ?>" name="image<?= $i ?>" class="d-none" onchange="previewImage(this, 'preview-image<?= $i ?>')">
                    </div>
                <?php } ?>
            </div>

            <div class="mt-4 text-center">
                <input type="submit" class="btn btn-success w-50" value="บันทึกการแก้ไข"></input>
            </div>
            <div class="mt-2 text-center">
                <a href="/course_own" class="btn btn-secondary w-50">ยกเลิกการแก้ไข</a>
            </div>
        </form>
    </div>
</div>