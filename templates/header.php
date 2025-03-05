<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSkill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
        .navbar a, .navbar button {
            color: white!important;
        }
        .nav-link.active {
            color: gold!important;
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
            /* border-radius: 24px; */
            margin: 0 auto;
            width: auto;
            max-width: 224px;
        }
        .searchbar:hover {
            box-shadow: 0 1px 6px rgb(32 33 36 / 28%);
            border-color: rgba(223,225,229,0);
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
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['timestamp'])) {
    ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand nav-link" href="/">TrainSkill</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="/course_create">สร้างกิจกรรม</a></li>
                        <li class="nav-item"><a class="nav-link" href="/course_own">กิจกรรมของคุณ</a></li>
                        <li class="nav-item"><a class="nav-link" href="/profile">ข้อมูลผู้ใช้</a></li>
                        <li class="nav-item"><a class="nav-link" href="/history">ประวัติการเข้าร่วม</a></li>
                    </ul>

                    <form class="d-flex">
                        <div class="searchbar">
                            <div class="searchbar-wrapper">
                                <div class="searchbar-left">
                                    <div class="search-icon-wrapper">
                                        <span class="search-icon searchbar-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="searchbar-center">
                                    <div class="searchbar-input-spacer"></div>
                                    <input type="search" class="searchbar-input" maxlength="2048" name="q" autocapitalize="off" autocomplete="off" title="Search" role="combobox" placeholder="ชื่อกิจกรรม/วัน">
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="btn btn-outline-light ms-2">
                        <a href="/logout" class="text-light text-decoration-none">ออกจากระบบ</a>
                    </div>
                </div>
            </div>
        </nav>
    <?php
    }
    ?>