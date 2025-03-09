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
    $check_sql = 'SELECT user_id FROM users WHERE email = ?';
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return false; 
    }

    // ถ้ามีไฟล์อัปโหลด ให้ใช้ฟังก์ชันอัปโหลด
    if ($file && !empty($file["name"])) {
        $profile_image = uploadProfileImage($file);
    } else {
        // ถ้าไม่มีไฟล์อัปโหลด ให้ใช้ unknown_person.jpg
        $defaultImage = "Unknown_person.jpg";
        $defaultPath = __DIR__ . "/../public/" . $defaultImage; // ไฟล์ต้นฉบับ
        $uploadPath = __DIR__ . "/../public/uploads/" . $defaultImage; // ปลายทาง

        // ตรวจสอบว่ามีไฟล์อยู่แล้วหรือไม่
        $newFileName = "Unknown_person.jpg"; // ตั้งค่าเริ่มต้น
        $fileCounter = 1;
        
        while (file_exists(__DIR__ . "/../public/uploads/" . $newFileName)) {
            $newFileName = "Unknown_person_" . $fileCounter . ".jpg";
            $fileCounter++;
        }

        // คัดลอกไฟล์ไปยัง uploads/ โดยใช้ชื่อไฟล์ที่ไม่ซ้ำ
        copy($defaultPath, __DIR__ . "/../public/uploads/" . $newFileName);

        $profile_image = $newFileName;
    }

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