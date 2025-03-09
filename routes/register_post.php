<?php

if (isset($_POST['g-recaptcha-response'])) {
    $recaptchaSecret = '6LeWWu4qAAAAAM0D818ONJioLImCW0CU94_c6Oqf';  // ใส่ Secret Key ของคุณที่นี่
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $remoteIp = $_SERVER['REMOTE_ADDR'];  // IP ของผู้ใช้

    // ส่งข้อมูลไปยัง Google เพื่อยืนยันว่า reCAPTCHA ตอบถูกต้อง
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $recaptchaSecret,
        'response' => $recaptchaResponse,
        'remoteip' => $remoteIp
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'content' => http_build_query($data),
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
        ]
    ];

    $context = stream_context_create($options);
    $verify = @file_get_contents($url, false, $context);  // ใช้ @ เพื่อหลีกเลี่ยง error warnings
    if ($verify === FALSE) {
        $_SESSION['message'] = 'เกิดข้อผิดพลาดในการตรวจสอบ reCAPTCHA';
        renderView('register_get');
        exit;
    }

    $responseKeys = json_decode($verify, true);

    // ตรวจสอบผลลัพธ์จาก Google reCAPTCHA
    if (intval($responseKeys["success"]) !== 1) {
        $_SESSION['message'] = 'Please verify that you are not a robot.';
        renderView('register_get');
        exit;
    } else {
        $user_name = htmlspecialchars(trim($_POST['user_name']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $phone_number = preg_replace('/\D/', '', $_POST['phone_number']);
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];

        $file = isset($_FILES['profile_picture']) ? $_FILES['profile_picture'] : null;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = 'Invalid email format';
            renderView('register_get');
            exit;
        }

        if (!verifyCSRFToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'คำขอไม่ถูกต้อง';
            renderView('register_get');
            exit;
        }

        if (!rateLimit($_SERVER['REMOTE_ADDR'])) {
            $_SESSION['message'] = 'มีการสมัครเกินกำหนด กรุณาลองใหม่ใน 15 นาทีภายหลัง';
            renderView('register_get');
            exit;
        }

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
            $_SESSION['message'] = 'รหัสผ่านต้องมีอย่างน้อย 8 ตัว';
            renderView('register_get');
            exit;
        }

        if ($password !== $confirm_password) {
            $_SESSION['message'] = 'รหัสผ่านไม่ตรงกัน';
            renderView('register_get');
            exit;
        }

        $registerSuccess = register($user_name, $email, $password, $phone_number, $birthday, $gender, $file);

        if ($registerSuccess) {
            $_SESSION['message'] = 'สมัครสำเร็จ';
            header('Location: /login');
            exit;
        } else {
            $_SESSION['message'] = 'อีเมลนี้ถูกใช้ไปแล้ว';
            renderView('register_get');
            exit;
        }
    }
} else {
    $_SESSION['message'] = 'Please complete the CAPTCHA.';
    renderView('register_get');
    exit;
}