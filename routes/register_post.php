<?php

$user_name = $_POST['user_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone_number = $_POST['phone_number'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];

if ($password === $confirm_password) {
    $file = isset($_FILES['profile_picture']) ? $_FILES['profile_picture'] : null;

    if (register($user_name, $email, $password, $phone_number, $birthday, $gender, $file)) {
        $_SESSION['message'] = 'Registration successful!';
        header('Location: /');
        exit;
    } else {
        $_SESSION['message'] = 'Email is already registered';
    }
} else {
    $_SESSION['message'] = 'Password do not match';
}

renderView('register_get');