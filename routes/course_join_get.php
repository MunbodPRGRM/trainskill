<?php

$courseId = $_GET['id'];
$userId = $_SESSION['user_id'];

$join = joinCourse($courseId, $userId);

if ($join) {
    $registration = getRegistrationToTraining($userId, $courseId);
    $registrationId = $registration->fetch_assoc()['registration_id'];

    $result = createTraining($userId, $courseId, $registrationId);

    if ($result) {
        header('Location: /history');
    } else {
        echo 'เกิดข้อผิดพลาดในการเข้าร่วมกิจกรรม';
    }
}
