<head>
    <title>TrainSkill-สร้างกิจกรรม</title>
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
            resize: none; /* ห้ามปรับขนาด */
        }
    </style>
</head>
<div class="container mt-4 content">
    <div class="card p-4">
        <form action="/course_create" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- อัปโหลดรูปหลัก -->
                <div class="col-12 col-md-6 d-flex align-items-center justify-content-center mb-3 mb-md-0">
                    <label for="image1" class="border d-flex align-items-center justify-content-center bg-dark text-light image-upload-titel">
                        <img id="preview1" src="#" alt="+" class="d-none w-100 h-100 object-fit-cover">
                    </label>
                    <input type="file" id="image1" name="image1" class="d-none" accept="image/jpeg, image/png" onchange="previewImage(this, 'preview1')">
                </div>

                <div class="col-12 col-md-6">
                    <div class="mb-2">
                        <label for="name" class="form-label">ชื่อกิจกรรม</label>
                        <input type="text" id="name" name="course_name" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
                        <textarea type="text" id="description" name="description" class="form-control" style="height: 100px;"></textarea>
                    </div>
                    <div class="mb-2">
                    <label for="max_participants" class="form-label">จำนวนคนสูงสุด</label>
                    <input type="number" id="max_participants" max="100000" name="max_participants" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="d-flex flex-column flex-md-row">
                            <div class="mb-2 me-md-2 flex-fill">
                                <label for="start_date" class="form-label">วันที่เริ่ม</label>
                                <input type="date" id="start_date" name="start_date" class="form-control">
                            </div>
                            <div class="mb-2 flex-fill">
                                <label for="end_date" class="form-label">วันที่สิ้นสุด</label>
                                <input type="date" id="end_date" name="end_date" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- อัปโหลดรูปเพิ่มเติม -->
            <div class="row mt-3">
                <div class="col-12 col-md-4">
                    <label for="image2" class="border d-flex align-items-center justify-content-center bg-dark text-light image-upload">
                        <img id="preview2" src="#" alt="+" class="d-none w-100 h-100 object-fit-cover">
                    </label>
                    <input type="file" id="image2" name="image2" class="d-none" accept="image/jpeg, image/png" onchange="previewImage(this, 'preview2')">
                </div>
                <div class="col-12 col-md-4">
                    <label for="image3" class="border d-flex align-items-center justify-content-center bg-dark text-light image-upload">
                        <img id="preview3" src="#" alt="+" class="d-none w-100 h-100 object-fit-cover">
                    </label>
                    <input type="file" id="image3" name="image3" class="d-none" accept="image/jpeg, image/png" onchange="previewImage(this, 'preview3')">
                </div>
                <div class="col-12 col-md-4">
                    <label for="image4" class="border d-flex align-items-center justify-content-center bg-dark text-light image-upload">
                        <img id="preview4" src="#" alt="+" class="d-none w-100 h-100 object-fit-cover">
                    </label>
                    <input type="file" id="image4" name="image4" class="d-none" accept="image/jpeg, image/png" onchange="previewImage(this, 'preview4')">
                </div>
            </div>

            <div class="mt-4 text-center">
                <input type="submit" name="submit" class="btn btn-success w-50" value="สร้างกิจกรรม"></input>
            </div>
        </form>
    </div>
</div>