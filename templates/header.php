<html>

<head></head>

<body>
    <header>
        <h1>ระบบลงทะเบียนกิจกรรมอบรมพัฒนาทักษะ</h1>
    </header>
    <nav>
        <?php
        if (isset($_SESSION['timestamp'])) {
        ?>
            <a href="/">Home</a>
            <a href="/">Create an activity</a>
            <a href="/">Your activity</a>
            <a href="/profile">Profile</a>
            <a href="/">History</a>

            <input type="text" placeholder="ค้นหากิจกรรม">
            <a href="/logout">ออกจากระบบ</a>
        <?php
        } else {
        ?>
            <a href="/">หน้าแรก</a>
            <a href="/login">เข้าสู่ระบบ</a>
        <?php
        }
        ?>
    </nav>