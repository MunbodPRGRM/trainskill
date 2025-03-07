<?php

function login(String $email, String $password)
{
    $conn = getConnection();
    $sql = 'SELECT * FROM users WHERE email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return false; 
    }

    $row = $result->fetch_assoc();

    if (isset($row['password']) && password_verify($password, $row['password'])) {
        return $row; 
    } else {
        return false; 
    }
}

function logout()
{
    unset($_SESSION['timestamp']);
}

function register(String $user_name, String $email, String $password, String $phone_number, String $birthday, String $gender) {
    $conn = getConnection();
    $check_sql = 'SELECT user_id FROM users WHERE email = ?';
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return false; 
    }

    $profile_image = uploadProfileImage($_FILES['profile_picture']); 

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = 'INSERT INTO users (user_name, email, password, phone_number, birthday, gender, profile_image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssss', $user_name, $email, $hashed_password, $phone_number, $birthday, $gender, $profile_image);
    
    return $stmt->execute(); 
}