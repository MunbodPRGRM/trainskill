<?php

function getRegistrationsByUserId(int $user_id)
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.user_name 
        FROM registration r
        INNER JOIN courses c ON r.course_id = c.course_id
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE r.user_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function getRegistrationByCourseId(int $course_id)
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.user_name 
        FROM registration r
        INNER JOIN courses c ON r.course_id = c.course_id
        INNER JOIN users u ON c.user_id = u.user_id
        WHERE r.course_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $course_id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function getRegistrationToTraining(int $user_id, int $course_id)
{
    $conn = getConnection();
    $sql = '
        SELECT r.*
        FROM registration r
        WHERE r.user_id = ? AND r.course_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $course_id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function joinCourse(int $course_id, int $user_id)
{
    $conn = getConnection();
    $sql = '
        INSERT INTO registration (course_id, user_id)
        VALUES (?, ?)
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $course_id, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function getRegistrationId(int $course_id, int $user_id)
{
    $conn = getConnection();
    $sql = '
        SELECT registration_id
        FROM registration
        WHERE course_id = ? AND user_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $course_id, $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['registration_id'];
}

function deleteRegistration(int $registrationId)
{
    $conn = getConnection();
    $sql = '
        DELETE FROM registration
        WHERE registration_id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $registrationId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function getNumberParticipants(int $course_id)
{
    $conn = getConnection();
    $sql = '
        SELECT COUNT(*) as num_participants
        FROM training t
        INNER JOIN registration r ON t.registration_id = r.registration_id
        WHERE r.course_id = ?
        AND t.status = "accepted";
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $course_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['num_participants'];
}