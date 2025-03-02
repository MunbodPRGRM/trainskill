<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSkill-สมัครสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100" style="background: linear-gradient(to right, #cfd9df, #4364f7);">
    <div class="card p-4 shadow" style="width: 350px; background: #f8f9fa; border-radius: 10px;">
        <h2 class="text-center">สมัครสมาชิก</h2>
        <form action="/register" method="post">
            <div class="mb-3">
                <label for="user_name" class="form-label">ชื่อผู้ใช้</label>
                <input type="text" id="user_name" name="user_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">สมัคร</button>
        </form>
        <p class="text-center mt-3">มีบัญชีแล้ว? <a href="/login">เข้าสู่ระบบ</a></p>

        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-info text-center mt-2">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
    </div>
</body>
</html>
