<?php

$id = $_GET['id'];

$result = deleteCourse($id);

if ($result) {
    header('Location: /course_own');
} else {
    echo 'เกิดข้อผิดพลาดในการลบข้อมูล';
}