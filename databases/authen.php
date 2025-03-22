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

function register(String $user_name, String $email, String $password, String $phone_number, String $birthday, String $gender, $file = null) {
    $conn = getConnection();

    $email = strtolower($email);
    
    $check_sql = 'SELECT user_id FROM users WHERE email = ? LIMIT 1';
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return false; 
    }

    $profile_image = ($file && !empty($file["name"])) ? uploadProfileImage($file) : copyDefaultProfileImage();

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = 'INSERT INTO users (user_name, email, password, phone_number, birthday, gender, profile_image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssss', $user_name, $email, $hashed_password, $phone_number, $birthday, $gender, $profile_image);
    
    return $stmt->execute(); 
}

function updatePassword(String $email, String $password)
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

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = 'UPDATE users SET password = ? WHERE email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $hashed_password, $email);

    if ($stmt->execute()) {
        return true;  
    } else {
        return false;  
    }
}

function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function rateLimit($ip) {
    $maxAttempts = 5; 
    $timeFrame = 15 * 60; // 15 นาที

    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = [];
    }

    $_SESSION['login_attempts'] = array_filter($_SESSION['login_attempts'], function ($timestamp) use ($timeFrame) {
        return $timestamp > time() - $timeFrame;
    });

    if (count($_SESSION['login_attempts']) >= $maxAttempts) {
        return false; // บล็อกการสมัคร
    }

    $_SESSION['login_attempts'][] = time();
    return true;
}