<?php

$course_id = $_POST['course_id'];
$courseName = $_POST['name'];
$description = $_POST['description'];
$max = $_POST['max'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

$result = editCourse($course_id, $courseName, $description, $max, $startDate, $endDate);

if ($result) {
    header('Location: /');
} else {
    echo 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล';
}