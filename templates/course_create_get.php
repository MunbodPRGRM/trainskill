<head>
    <title>TrainSkill-สร้างกิจกรรม</title>
</head>
<div class="container mt-4 content">
    <div class="card p-4">
        <form action="/course_create" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- อัปโหลดรูปหลัก -->
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <label for="image1" class="border d-flex align-items-center justify-content-center bg-dark text-light w-100" style="height: 150px; cursor: pointer;">
                        <span>+</span>
                    </label>
                    <input type="file" id="image1" name="image1" class="d-none">
                </div>

                <div class="col-md-8">
                    <div class="mb-2">
                        <label for="name" class="form-label">ชื่อกิจกรรม</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
                        <input type="text" id="description" name="description" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="max" class="form-label">จำนวนคนสูงสุด</label>
                        <input type="number" id="max" name="max" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="start_date" class="form-label">วันที่เริ่ม</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="end_date" class="form-label">วันที่สิ้นสุด</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>
                </div>
            </div>

            <!-- อัปโหลดรูปเพิ่มเติม -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="image2" class="border d-flex align-items-center justify-content-center bg-dark text-light w-100" style="height: 150px; cursor: pointer;">
                        <span>+</span>
                    </label>
                    <input type="file" id="image2" name="image2" class="d-none">
                </div>
                <div class="col-md-4">
                    <label for="image3" class="border d-flex align-items-center justify-content-center bg-dark text-light w-100" style="height: 150px; cursor: pointer;">
                        <span>+</span>
                    </label>
                    <input type="file" id="image3" name="image3" class="d-none">
                </div>
                <div class="col-md-4">
                    <label for="image4" class="border d-flex align-items-center justify-content-center bg-dark text-light w-100" style="height: 150px; cursor: pointer;">
                        <span>+</span>
                    </label>
                    <input type="file" id="image4" name="image4" class="d-none">
                </div>
            </div>

            <div class="mt-4 text-center">
                <input type="submit" class="btn btn-success w-50" value="สร้างกิจกรรม"></input>
            </div>
        </form>
    </div>
</div>