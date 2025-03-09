<?php
$user_id = $_SESSION['user_id'];
$user_name = htmlspecialchars(trim($_POST['user_name']));
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone_number = preg_replace('/\D/', '', $_POST['phone_number']); // ลบอักขระที่ไม่ใช่ตัวเลข
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];

$result = getUserById($_SESSION['user_id']);

if (!empty($password)) {
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีอย่างน้อย 8 ตัว';
    }

    if (isset($_SESSION['error'])) {
        header('location: /profile_edit');
        exit();
    }
}

$profile_picture = null;
if (!empty($_FILES['profile_picture']['name'])) {
    $profile_picture = updateProfileImage($_FILES['profile_picture'], $user_id);
    if ($profile_picture === false) {
        $_SESSION['error'] = 'รูปภาพไม่ถูกต้อง';
        header('location: /profile_edit');
        exit();
    }
}

$result = editProfile($user_id, $user_name, $password, $phone_number, $birthday, $gender, $profile_picture);

if ($result) {
    $_SESSION['success'] = 'แก้ไขข้อมูลเรียบร้อย';
    header('Location: /profile');
    exit();
} else {
    $_SESSION['error'] = 'การอัปเดตข้อมูลล้มเหลว';
}

renderView('profile_edit_get', ['result' => $result]);
unset($_SESSION['success']);
unset($_SESSION['error']);