<?php

function getCourses(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.user_name 
        FROM courses c
        INNER JOIN users u ON c.user_id = u.user_id
    ';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function getCourseByName(string $course_name): mysqli_result|bool
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

function getCourseById(int $course_id): mysqli_result|bool
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

function getCourseByUserId(int $user_id): mysqli_result|bool
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.user_name 
        FROM courses c
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE c.user_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    
    $result = $stmt->get_result();

    return $result;
}

function createCourse(String $courseName, String $description, int $max, String $startDate, String $endDate, int $userId): bool
{
    $conn = getConnection();
    $sql = '
        INSERT INTO courses (course_name, description, max, start_date, end_date, user_id)
        VALUES (?, ?, ?, ?, ?, ?)
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssisss', $courseName, $description, $max, $startDate, $endDate, $userId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function editCourse(int $course_id, string $course_name, string $description, int $max, string $start_date, string $end_date,): bool
{
    $conn = getConnection();
    $sql = '
        UPDATE courses
        SET course_name = ?, description = ?, max = ?, start_date = ?, end_date = ?
        WHERE course_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssisss', $course_name, $description, $max, $start_date, $end_date, $course_id);
    $result = $stmt->execute();

    return $result;
}

function deleteCourse(int $course_id): bool
{
    $conn = getConnection();
    $sql = '
        DELETE FROM courses
        WHERE course_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $course_id);
    $result = $stmt->execute();

    return $result;
}

function getCoursesByKeyword(string $keyword): mysqli_result|bool
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.user_name 
        FROM courses c
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE c.course_name LIKE ?
    ';
    $stmt = $conn->prepare($sql);
    $keyword = "%$keyword%";
    $stmt->bind_param('s', $keyword);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}