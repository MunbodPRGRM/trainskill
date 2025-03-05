<?php

function getConnection():mysqli
{
    $hostname = 'localhost';
    $dbName = 'trainskill';
    $username = 'trainskill';
    $password = 'abc1234';
    $conn = new mysqli($hostname, $username, $password, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

require_once DATABASE_DIR . '/users.php';
require_once DATABASE_DIR . '/authen.php';
require_once DATABASE_DIR . '/courses.php';
require_once DATABASE_DIR . '/registration.php';
require_once DATABASE_DIR . '/training.php';
require_once DATABASE_DIR . '/images.php';