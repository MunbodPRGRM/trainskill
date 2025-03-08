<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSkill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* ทำให้หน้าผู้ใช้มีความสูงเต็มจอ */
        }

        footer {
            margin-top: auto;
            /* ใช้ auto margin ให้ footer อยู่ด้านล่างสุด */
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
        }

        .navbar a,
        .navbar button {
            color: white !important;
        }

        .nav-link.active {
            color: gold !important;
        }

        .searchbar {
            font-size: 14px;
            font-family: arial, sans-serif;
            color: #202124;
            display: flex;
            z-index: 3;
            height: 44px;
            background: white;
            border: 1px solid #dfe1e5;
            box-shadow: none;
            border-radius: 24px;
            margin: 0 auto;
            width: auto;
            width: 600px;
        }

        .searchbar:hover {
            box-shadow: 0 1px 6px rgb(32 33 36 / 28%);
            border-color: rgba(223, 225, 229, 0);
        }

        .searchbar-wrapper {
            flex: 1;
            display: flex;
            padding: 5px 8px 0 14px;
        }

        .searchbar-left {
            font-size: 14px;
            font-family: arial, sans-serif;
            color: #202124;
            display: flex;
            align-items: center;
            padding-right: 13px;
            margin-top: -5px;
        }

        .search-icon-wrapper {
            margin: auto;
        }

        .search-icon {
            margin-top: 3px;
            color: #9aa0a6;
            height: 20px;
            line-height: 20px;
            width: 20px;
        }

        .searchbar-icon {
            display: inline-block;
            fill: currentColor;
            height: 24px;
            line-height: 24px;
            position: relative;
            width: 24px;
        }

        .searchbar-center {
            display: flex;
            flex: 1;
            flex-wrap: wrap;
        }

        .searchbar-input-spacer {
            color: transparent;
            flex: 100%;
            white-space: pre;
            height: 34px;
            font-size: 16px;
        }

        .searchbar-input {
            background-color: transparent;
            border: none;
            margin: 0;
            padding: 0;
            color: rgba(0, 0, 0, .87);
            word-wrap: break-word;
            outline: none;
            display: flex;
            flex: 100%;
            margin-top: -35px;
            height: 34px;
            font-size: 16px;
            max-width: 100%;
            width: 100%;
        }

        .searchbar-right {
            display: flex;
            flex: 0 0 auto;
            margin-top: -5px;
            align-items: stretch;
            flex-direction: row
        }

        .searchbar-clear-icon {
            margin-right: 12px
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-section {
            text-align: center;
            color: white;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_SESSION['timestamp'])) {
        $profile = getUserById($_SESSION['user_id']);
    ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">

                <div class="navbar-brand d-flex align-items-center me-3">
                    <a href="/profile" class="text-decoration-none profile-section nav-link">
                        <img src="<?= $profile['profile_image'] ?>" alt="Profile Image" class="rounded-circle" width="50" height="50">
                        <!-- <div>ใส่ชื่อไปแล้วมันไม่ค่อยดูดีเท่าไหร</div> -->
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="/">TrainSkill</a></li>
                        <li class="nav-item"><a class="nav-link" href="/course_create">สร้างกิจกรรม</a></li>
                        <li class="nav-item"><a class="nav-link" href="/course_own">กิจกรรมของคุณ</a></li>
                        <li class="nav-item"><a class="nav-link" href="/history">ประวัติการเข้าร่วม</a></li>
                    </ul>

                    <div class="btn btn-danger ms-2">
                        <a href="/logout" class="text-decoration-none">ออกจากระบบ</a>
                    </div>
                </div>
            </div>
        </nav>
    <?php
    }
    ?>