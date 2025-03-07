<?php

if (isset($_GET['bt'])) {
    $user_id = $_GET['user_id'];
    $course_id = $_GET['course_id'];
    $bt = $_GET['bt'];

    if ($bt === '1') {
        $attendance = 'present';
    } else if ($bt === '2') {
        $attendance = 'absent';
    }

    $update = updateAttendance($user_id, $course_id, $attendance);

    if ($update) {
        header('Location: /check_participant?course_id=' . $course_id);
    } else {
        echo 'Error';
    }
}

$result = getTrainingByCourseId($_GET['course_id']);

renderView('check_participant_get', ['training' => $result]);