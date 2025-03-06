<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSkill-สมัครสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            /* position: relative;
            max-width: 500px;
            max-height: 540px;
            width: 100%;
            background:rgb(255, 255, 255);
            padding: 25px;
            border-radius: 10px; */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container header {
            font-size: 1.2rem;
            color: #000;
            font-weight: 600;
            text-align: center;
            margin-top: -10px;
        }
        .container .form {
            margin-top: 15px;
        }
        .form .input-box {
            width: 100%;
            margin-top: 10px;
        }
        .input-box label {
            color: #000;
        }
        .form :where(.input-box input, .select-box) {
            position: relative;
            height: 35px;
            width: 100%;
            outline: none;
            font-size: 1rem;
            color: #808080;
            margin-top: 5px;
            border: 1px solid rgb(172, 199, 227);
            border-radius: 6px;
            padding: 0 15px;
            background:rgb(255, 255, 255);
        }
        .input-box input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }
        .form .column {
            display: flex;
            column-gap: 15px;
        }
        .form .gender-box {
            margin-top: 10px;
        }
        .form :where(.gender-option, .gender) {
            display: flex;
            align-items: center;
            column-gap: 50px;
            flex-wrap: wrap;
        }
        .form .gender {
            column-gap: 5px;
        }
        .gender input {
            accent-color:rgb(14, 29, 100)
        }
        .form :where(.gender input, .gender label) {
            cursor: pointer;
        }
        .gender label {
            color: #000;
        }
        .form button {
            height: 40px;
            width: 100%;
            font-size: 1rem;
            font-weight: 400;
            margin-top: 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: linear-gradient(to right,rgb(100, 169, 212),rgb(99, 152, 227));
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            height: 620px;
            width: 100%;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 2px solid rgb(255, 255, 255);
            object-fit: cover;
        }
        .form-container {
            max-width: 500px;
            height: 620px;
            width: 100%;
            background: white;
            padding: 30px;
        }
        @media (max-width: 766px) {
            .container {
                flex-direction: column; /* จัดวางให้เป็นแนวตั้ง */
            }
            .profile-container {
                width: 100%;
                height: 150px;
            }
            .form-container {
                width: 100%;
                height: auto;
                padding: 20px;
            }
            .profile-picture {
                width: 120px; /* ปรับขนาดรูปโปรไฟล์ให้พอดี */
                height: 120px;
            }
            .form .column {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }
        }
        @media (min-width: 767px) and (max-width: 769px) { 
            .profile-container {
                width: 100%;
                height: 620px;
            } 
            .form-container {
                width: 100%;
                height: 620px;
                padding: 20px;
            }
            .profile-picture {
                width: 120px; /* ปรับขนาดรูปโปรไฟล์ให้พอดี */
                height: 120px;
            } 
        }
    </style>
</head>
<body style="background: linear-gradient(to right, #cfd9df, #4364f7);">
    <section class="container">
        <div class="profile-container d-flex justify-content-center align-items-center">
            <label for="profile_picture">
                <img src="" class="profile-picture" id="preview">
            </label>
                <input class="d-none" type="file" id="profile_picture" name="profile_picture" accept="image/*" onchange="preview(event)">
            </div>
        </div>

        <div class="form-container">
            <header>Registration Form</header>
                <form class="form" action="/register" method="post">
                    <div class="input-box">
                        <label for="user_name">ชื่อผู้ใช้</label>
                        <input type="text" id="user_name" name="user_name" required>
                    </div>
                    <div class="column">
                        <div class="input-box">
                            <label for="phone_number">เบอร์โทรศัพท์</label>
                            <input type="telephone" id="phone_number" name="phone_number" required>
                        </div>
                        <div class="input-box">
                            <label for="birthday">วันเกิด</label>
                            <input type="date" id="birthday" name="birthday" required>
                        </div>
                    </div>
                    <div class="gender-box">
                        <label for="gender">Gender</label>
                        <div class="gender-option justify-content-center">
                            <div class="gender">
                                <input checked="" name="gender" id="check-male" type="radio" value="ชาย">
                                <label for="check-male">ชาย</label>
                            </div>
                            <div class="gender">
                                <input name="gender" id="check-female" type="radio" value="หญิง">
                                <label for="check-female">หญิง</label>
                            </div>
                            <div class="gender">
                                <input name="gender" id="check-other" type="radio" value="ไม่ระบุ">
                                <label for="check-other">ไม่ระบุ</label>
                            </div>
                        </div>
                    </div>
                    <div class="input-box">
                        <label for="email" class="form-label">อีเมล</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                        
                            <div class="input-box">
                                <label for="password" class="form-label">รหัสผ่าน</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="input-box">
                                <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                            </div>
                        
                    <button type="submit" class="btn btn-primary w-100">สมัคร</button>
                </form>
            <p class="text-center mt-3">มีบัญชีแล้ว? <a href="/login">เข้าสู่ระบบ</a></p>
        </div>
    </section>

    <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-info text-center mt-2">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
</body>

    <script>
        function preview(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</html>