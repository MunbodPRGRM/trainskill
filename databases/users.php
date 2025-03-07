<?php

function getUserById(int $id)
{
    $conn = getConnection();
    $sql = 'SELECT * FROM users WHERE user_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        return false; 
    }

    $user = $result->fetch_assoc(); 

    $profile = getUserProfile($id);
    
    if ($profile) {
        $user['profile_image'] = $profile['profile_image']; 
    } else {
        $user['profile_image'] = 'default.jpg';
    }

    return $user;
}

function editProfile(int $user_id, string $user_name, ?String $password, string $phone_number, string $birthday, string $gender, $profile_picture = null)
{
    $conn = getConnection();
    $sql = "UPDATE users SET user_name = ?, phone_number = ?, birthday = ?, gender = ?";
    $params = [$user_name, $phone_number, $birthday, $gender];

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql .= ", password = ?";
        $params[] = $hashed_password;
    }

    if ($profile_picture !== null) {
        $sql .= ", profile_image = ?";
        $params[] = $profile_picture;
    }

    $sql .= " WHERE user_id = ?";
    $params[] = $user_id;

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($params) - 1) . 'i', ...$params);

    if (!$stmt->execute()) {
        error_log("Error updating profile: " . $stmt->error);
        return false;
    }

    return true;
}

function getUserProfile($userId)
{
    $conn = getConnection(); 
    $sql = 'SELECT profile_image FROM users WHERE user_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($profileImage);
        $stmt->fetch();
        
        $profileImagePath = !empty($profileImage) ? 'uploads/' . $profileImage : 'uploads/default.jpg';  // หากไม่มีใช้ default.jpg

        return ['profile_image' => $profileImagePath]; 
    } else {
        return null;  
    }
}