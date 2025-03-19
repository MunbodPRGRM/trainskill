<?php

if (isset($_GET['user_id']) && isset($_GET['course_id'])) {
    $user_id = $_GET['user_id'];
    $course_id = $_GET['course_id'];
    $registrationId = getRegistrationId($course_id, $user_id);
    
    $delTraining = deleteTrainingByRegistrationId($registrationId);
    $delReg = deleteRegistration($registrationId);

    if ($delTraining && $delReg) {
        header('Location: /course?id=' . $course_id);
    } else {
        echo 'Failed to cancel course';
    }
} else {
    echo 'Invalid request';
}