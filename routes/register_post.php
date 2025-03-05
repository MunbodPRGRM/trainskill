<?php

$user_name = $_POST['user_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone_number = $_POST['phone_number'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];

if ($password === $confirm_password) {
    if (register($user_name, $email, $password, $phone_number, $birthday, $gender)) {
        $_SESSION['message'] = 'Registration successful!';
        header('Location: /');
        exit;
    } else {
        $_SESSION['message'] = 'Email is already registered. Please use a different email.';
    }
} else {
    $_SESSION['message'] = 'Password and Confirm Password do not match';
}

renderView('register_get');
unset($_SESSION['message']);