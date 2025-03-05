<?php

// จำเอาไว้นะ เพราะเราจะไม่เปลี่ยน table ใน database ดัวนั้นไฟล์ registration กับ training จะต้องใช้พร้อมกัน

function getTrainingByCourseId($courseId): mysqli_result|bool
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.*, r.*, t.*
        FROM training t
        INNER JOIN registration r ON t.registration_id = r.registration_id
        INNER JOIN users u ON r.user_id = u.user_id
        INNER JOIN courses c ON r.course_id = c.course_id
        WHERE c.course_id = ?;
    ';
    // จะได้ course*, user*, training*
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $courseId);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function getTrainingByRegistrationId($registrationId): mysqli_result|bool
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.*, r.*, t.*
        FROM training t
        INNER JOIN registration r ON t.registration_id = r.registration_id
        INNER JOIN users u ON r.user_id = u.user_id
        INNER JOIN courses c ON r.course_id = c.course_id
        WHERE r.registration_id = ?;
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $registrationId);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function getTrainingByUserId(int $user_id): mysqli_result|bool
{
    $conn = getConnection();
    $sql = '
        SELECT t.*, c.course_name, c.course_id, c.user_id, c.description, c.max_participants, u.user_name
        FROM training t
        INNER JOIN registration r ON t.registration_id = r.registration_id
        INNER JOIN courses c ON r.course_id = c.course_id
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE r.user_id = ?;
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function createTraining(int $registrationId): bool
{
    $conn = getConnection();
    $sql = '
        INSERT INTO training (registration_id, status)
        VALUES (?, "waiting");
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $registrationId);

    $result = $stmt->execute();

    return $result;
}

function updateStatus($user_id, $course_id, $status): bool
{
    $conn = getConnection();
    $sql = '
        UPDATE training t
        INNER JOIN registration r ON t.registration_id = r.registration_id
        SET t.status = ?
        WHERE r.user_id = ? AND r.course_id = ?;
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $status, $user_id, $course_id);

    $result = $stmt->execute();

    return $result;
}