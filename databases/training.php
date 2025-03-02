<?php

function getTrainingByCourseId($courseId): mysqli_result|bool
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.*, t.*
        FROM training t
        INNER JOIN users u ON t.user_id = u.user_id
        INNER JOIN courses c ON t.course_id = c.course_id
        WHERE c.course_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $courseId);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function getTrainingByUserId(int $user_id): mysqli_result|bool
{
    $conn = getConnection();
    $sql = '
        SELECT t.*, c.course_name, c.user_id, c.description, c.max, c.image1, u.user_name
        FROM training t
        INNER JOIN courses c ON t.course_id = c.course_id
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE t.user_id = ?;
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function createTraining(int $userId, int $courseId, int $registrationId): bool
{
    $conn = getConnection();
    $sql = '
        INSERT INTO training (user_id, course_id, registration_id, status)
        VALUES (?, ?, ?, "waiting");
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $userId, $courseId, $registrationId);

    $result = $stmt->execute();

    return $result;
}
