<?php

$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password === $confirm_password) {

    if (updatePassword($email, $password)) {
        $_SESSION['message'] = 'Change successful!';
        header('Location: /');
        exit;
    } else {
        $_SESSION['message'] = 'Email is wrong';
    }
} else {
    $_SESSION['message'] = 'Password do not match';
}

renderView('change_password_get');