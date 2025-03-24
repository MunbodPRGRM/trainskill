<?php

function getCourses()
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.user_name 
        FROM courses c
        INNER JOIN users u ON c.user_id = u.user_id
        ORDER BY c.course_id DESC
    ';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function getCourseByName(string $course_name)
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.user_name 
        FROM courses c
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE c.course_name = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $course_name);
    $stmt->execute();
    
    $result = $stmt->get_result();

    return $result;
}

function getCourseById(int $course_id)
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.user_name 
        FROM courses c
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE c.course_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $course_id);
    $stmt->execute();
    
    $result = $stmt->get_result();

    return $result;
}

function getCourseByUserId(int $user_id)
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.user_name 
        FROM courses c
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE c.user_id = ?
        ORDER BY c.course_id DESC
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    
    $result = $stmt->get_result();

    return $result;
}

function createCourse($courseName, $description, $maxParticipants, $startDate, $endDate, $userId) {
    $conn = getConnection(); 

    $stmt = $conn->prepare("INSERT INTO courses (course_name, user_id, description, start_date, end_date, max_participants) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssi", $courseName, $userId, $description, $startDate, $endDate, $maxParticipants);

    if ($stmt->execute()) {
        $courseId = $conn->insert_id; 
        $stmt->close();

        uploadCourseImages($courseId, $_FILES); 

        return true; 
    } else {
        $stmt->close();
        return false; 
    }
}

function editCourse(int $course_id, string $course_name, string $description, int $max, string $start_date, string $end_date, $files)
{
    $conn = getConnection();

    $sql = '
            UPDATE courses
            SET course_name = ?, description = ?, max_participants = ?, start_date = ?, end_date = ?
            WHERE course_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssissi', $course_name, $description, $max, $start_date, $end_date, $course_id);
    $result = $stmt->execute();
    $stmt->close();

    if ($result) {
        updateImages($course_id, $files);
        return true;  
    } else {
        return false;
    }
}

function deleteCourse(int $course_id) {
    $conn = getConnection();

    deleteImage($course_id);

    $sql = "DELETE FROM courses WHERE course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $course_id);
    $result = $stmt->execute();

    $stmt->close();

    return $result;
}

function search(string $searchInput, ?string $startDate = null, ?string $endDate = null)
{
    $conn = getConnection();

    $sql = '
        SELECT c.*, u.user_name 
        FROM courses c
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE c.course_name LIKE ?
    ';

    $params = ["%$searchInput%"];
    $types = 's';

    if (!empty($startDate) && !empty($endDate)) {
        $sql .= ' AND (
            (c.start_date >= ? AND c.end_date <= ?) 
            OR (c.start_date <= ? AND c.end_date >= ?) 
            OR (c.start_date <= ? AND c.end_date >= ?) 
        )';
        $params[] = $startDate;
        $params[] = $endDate;
        $params[] = $endDate;
        $params[] = $startDate;
        $params[] = $startDate;
        $params[] = $endDate;
        $types .= 'ssssss';
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function searchDate(string $startDate, string $endDate)
{
    $conn = getConnection();

    $sql = '
        SELECT c.*, u.user_name 
        FROM courses c
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE (c.start_date >= ? AND c.end_date <= ?)
           OR (c.start_date <= ? AND c.end_date >= ?)
           OR (c.start_date <= ? AND c.end_date >= ?)
    ';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $startDate, $endDate, $endDate, $startDate, $startDate, $endDate); // ผูกพารามิเตอร์
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function hasJoinedCourse($user_id, $course_id)
{
    // ฟังก์ชันนี้ควรตรวจสอบในฐานข้อมูลว่าผู้ใช้ได้เข้าร่วมกิจกรรมนี้แล้วหรือไม่
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) FROM registration WHERE user_id = ? AND course_id = ?");
    $stmt->bind_param("ii", $user_id, $course_id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count > 0;
}