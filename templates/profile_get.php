<head>
    <title>TrainSkill-โปรไฟล์</title>
</head>

<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-5" style="max-width: 600px; width: 100%;">
            <div class="text-center">
                <?php
                $imageData = base64_encode($data['result']['image']);
                echo '<img src="data:image/jpeg;base64,' . $imageData . '" class="rounded-circle img-fluid" style="width: 150px; height: 150px;" alt="โปรไฟล์">';
                ?>
            </div>
            <div class="mt-4">
                <h4 class="text-center">ข้อมูลผู้ใช้</h4>
                <hr>
                <p><strong>ID ผู้ใช้:</strong> <?= $data['result']['user_id'] ?></p>
                <p><strong>ชื่อผู้ใช้:</strong> <?= $data['result']['user_name'] ?></p>
                <p><strong>อีเมล:</strong> <?= $data['result']['email'] ?></p>
                <p><strong>เพศ:</strong> <?= $data['result']['gender'] ?></p>
                <p><strong>วันเกิด:</strong> <?= $data['result']['birthday'] ?></p>
                <p><strong>เบอร์โทรศัพท์:</strong> <?= $data['result']['phone_number'] ?></p>
            </div>
        </div>
    </div>