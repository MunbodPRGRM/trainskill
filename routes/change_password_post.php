<?php

$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = 'Invalid email format';
} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
    $_SESSION['message'] = 'รหัสผ่านต้องมีอย่างน้อย 8 ตัว';
} elseif ($password !== $confirm_password) {
    $_SESSION['message'] = 'Password do not match';
} elseif (updatePassword($email, $password)) {
    $_SESSION['message'] = 'Change successful!';
    header('Location: /login');
    exit;
} else {
    $_SESSION['message'] = 'Email is wrong';
}

renderView('change_password_get');