<section>
    <h1>เข้าสู่ระบบ</h1>
    <form action="/login" method="post">
        <label for="email">อีเมล:</label>
        <input type="email" id="email" name="email"><br>
        <label for="password">รหัสผ่าน:</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="เข้าสู่ระบบ"></input>
    </form>

    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
</section>