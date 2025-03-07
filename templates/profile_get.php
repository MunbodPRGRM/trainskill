<head>
    <title>TrainSkill-โปรไฟล์</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
if (isset($_SESSION['success'])) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({icon: 'success', title: 'สำเร็จ!', text: '" . $_SESSION['success'] . "', confirmButtonText: 'ตกลง', 
                customClass: {confirmButton: 'btn btn-success'},
                buttonsStyling: false
            });
        });
    </script>";
    unset($_SESSION['success']);
}
?>

<div class="container d-flex justify-content-center align-items-center vh-100 mt-3">
        <div class="card shadow-lg p-5" style="max-width: 600px; width: 100%;">
            <div class="text-center">
                <img src="<?= $data['result']['profile_image'] ?>" alt="Profile Image" class="rounded-circle" width="140" height="140">
            </div>
            <div class="mt-4">
                <h4 class="text-center">ข้อมูลผู้ใช้</h4>
                <hr>
                <div class="text-center mt-4 mb-4">
                    <a href="/profile_edit?id=<?= $data['result']['user_id'] ?>"><button class="btn btn-primary">แก้ไขข้อมูล</button></a>
                </div>
                <p><strong>ID ผู้ใช้:</strong> <?= $data['result']['user_id'] ?></p>
                <p><strong>ชื่อผู้ใช้:</strong> <?= $data['result']['user_name'] ?></p>
                <p><strong>อีเมล:</strong> <?= $data['result']['email'] ?></p>
                <p><strong>เพศ:</strong> <?= $data['result']['gender'] ?></p>
                <p><strong>วันเกิด:</strong> <?= $data['result']['birthday'] ?></p>
                <p><strong>เบอร์โทรศัพท์:</strong> <?= $data['result']['phone_number'] ?></p>
            </div>
        </div>
    </div>