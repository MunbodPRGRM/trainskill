<?php

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    $course = getCourseById($course_id);
    renderView('checkname_get', ['course' => $course]);
} else {
    echo 'error';
}