<?php

$course_id = $_POST['course_id'];
$courseName = $_POST['name'];
$description = $_POST['description'];
$max = $_POST['max_participants'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

$result = editCourse($course_id, $courseName, $description, $max, $startDate, $endDate, $_FILES);

if ($result) {
    $_SESSION['success'] = 'แก้ไขข้อมูลสำเร็จ';
    header('Location: /');
    exit;
} else {
    echo 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล';
}