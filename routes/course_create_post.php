<?php

$courseName = $_POST['course_name'];
$description = $_POST['description'];
$max = $_POST['max_participants'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];
$userId = $_SESSION['user_id'];

$result = createCourse($courseName, $description, $max, $startDate, $endDate, $userId);

if ($result) {
    header('Location: /');
} else {
    echo 'เกิดข้อผิดพลาดในการสร้างกิจกรรม';
}