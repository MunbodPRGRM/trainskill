<?php

$email = $_POST['email'];
$password = $_POST['password'];
$result = login($email, $password);

if ($result) {
    $unix_timestamp = time();
    $_SESSION['timestamp'] = $unix_timestamp;
    $_SESSION['user_id'] = $result['user_id'];

    $result = getCourses();
    header('Location: /');
    renderView('home_get', ['courses' => $result]);
    
} else {
    $_SESSION['message'] = 'Email or Password invalid';
    renderView('login_get');
    
    unset($_SESSION['message']);
    unset($_SESSION['timestamp']);
}
