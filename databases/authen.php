<?php

function login(String $email, String $password): array|bool
{
    $conn = getConnection();
    $sql = 'select * from users where email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        return false;
    }

    $row = $result->fetch_assoc();

    //password_verify($password, $row['password'])
    //$password === $row['password']
    if ($password === $row['password']) {
        return $row;
    } else {
        return false;
    }
}

function logout(): void
{
    unset($_SESSION['timestamp']);
}

function register(String $user_name, String $email, String $password): void
{
    $conn = getConnection();
    $sql = 'insert into users (user_name, email, password) values (?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $user_name, $email, $password);
    $stmt->execute();
}