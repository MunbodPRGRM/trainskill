<?php

$user_name = $_POST['user_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password == $confirm_password) {
    $result = register($user_name, $email, $password);
} else {
    $_SESSION['message'] = 'Password and Confirm Password not match';
    renderView('register_get');

    unset($_SESSION['message']);
}

header('Location: /');
renderView('home_get');
