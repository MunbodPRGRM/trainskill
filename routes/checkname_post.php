<?php

if (isset($_POST['otp'])) {
    $user_id = $_SESSION['user_id'];
    $course_id = $_POST['course_id'];
    $otp = $_POST['otp'];

    $registration_id = getRegistrationId($course_id, $user_id);
    $db_otp = getOTPByRegistrationId($registration_id);

    if ($otp === $db_otp) {
        updateAttendance($user_id, $course_id, "present");

        header('Location: /history');
    } else if ($otp !== $db_otp) {
        $_SESSION['message'] = "ใส่รหัส OTP ผิด";

        header('Location: /checkname?course_id=' . $course_id);
    }
}

?>
