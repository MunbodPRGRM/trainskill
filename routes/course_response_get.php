<?php

$user_id = $_GET['user_id'];
$course_id = $_GET['course_id'];
$status = $_GET['status'];
$bt = $_GET['bt'];

if ($bt === '0') {
    if ($status === 'accepted' || $status === 'cancelled') {
        $status = 'waiting';
    } else {
        $status = 'accepted';
    }
} else if ($bt === '1') {
    $status = 'accepted';
} else if ($bt === '2') {
    $status = 'cancelled';
}

$result = updateStatus($user_id, $course_id, $status);

if ($result) {
    header('Location: /course_participant?id=' . $course_id);
} else {
    echo 'Error';
}