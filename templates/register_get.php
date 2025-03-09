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
            background: rgb(255, 255, 255);
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
            accent-color: rgb(14, 29, 100)
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
            background: linear-gradient(to right, rgb(100, 169, 212), rgb(99, 152, 227));
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
        /* ปรับแต่งให้ popup ปรากฏขึ้นที่ด้านบน */
        .popup-message {
            position: fixed;
            margin-top: 40px;
            top: 10px; /* ตำแหน่งจากด้านบนของหน้า */
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050; /* ให้ popup อยู่ข้างบนสุด */
            max-width: 300px;
            width: 100%;
            padding: 10px 20px;
            background-color:rgb(220, 72, 72); /* สีพื้นหลัง (สีเขียว) */
            color: white;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: none; /* ซ่อนก่อน */
            opacity: 0; /* ซ่อนก่อน */
            transition: opacity 0.3s ease, top 0.3s ease; /* ทำให้แสดงอย่างค่อยเป็นค่อยไป */
        }
        /* แสดงผลเมื่อ popup ถูกแสดง */
        .popup-message.show {
            display: block;
            opacity: 1;
            top: 20px; /* ปรับให้ขึ้นมาจากด้านบน */
        }

        @media (max-width: 766px) {
            body {
                padding-top: 40px;
            }
            .container {
                flex-direction: column;
                /* จัดวางให้เป็นแนวตั้ง */
            }
            .profile-container {
                width: 100%;
                height: 200px;
            }
            .form-container {
                width: 100%;
                height: auto;
                padding: 20px;
                margin-bottom: 50px;
            }
            .profile-picture {
                width: 120px;
                /* ปรับขนาดรูปโปรไฟล์ให้พอดี */
                height: 120px;
            }
            .form .column {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }
            .popup-message {
                margin-top: 20px;
                max-width: 240px;
                font-size: smaller;
            }
        }

        @media (min-width: 767px) and (max-width: 992px) {
            body {
                padding-top: 40px;
            }
            .profile-container {
                width: 100%;
                height: 680px;
                margin-bottom: 50px;
            }
            .form-container {
                width: 100%;
                height: 680px;
                padding: 20px;
                margin-bottom: 50px;
            }
            .profile-picture {
                width: 120px;
                /* ปรับขนาดรูปโปรไฟล์ให้พอดี */
                height: 120px;
            }
            .form .column {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }
            .popup-message {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body style="background: linear-gradient(to right, #cfd9df, #4364f7);">
    <section class="container">
        <div class="profile-container d-flex justify-content-center align-items-center">
            <p>เลือกรูปโปรไฟล์</p>
            <label for="profile_picture">
                <img src="Unknown_person.jpg" class="profile-picture" id="preview">
            </label>
        </div>
        </div>

        <div class="form-container">
            <header>Registration Form</header>
            <form class="form" action="/register" method="post" enctype="multipart/form-data">
                <input class="d-none" type="file" id="profile_picture" name="profile_picture" accept="image/jpeg, image/png, image/gif" onchange="preview(event)">
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
                            <input checked="" name="gender" id="check-male" type="radio" value="male">
                            <label for="check-male">male</label>
                        </div>
                        <div class="gender">
                            <input name="gender" id="check-female" type="radio" value="female">
                            <label for="check-female">female</label>
                        </div>
                        <div class="gender">
                            <input name="gender" id="check-other" type="radio" value="unknown">
                            <label for="check-other">unknown</label>
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
        if (isset($_SESSION['message'])):
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
        <div id="popupMessage" class="popup-message text-center">
            ❌ <?= $message; ?>
        </div>

        <script>
            // ใช้ JavaScript สำหรับแสดง popup เมื่อข้อความมีค่า
            document.addEventListener("DOMContentLoaded", function() {
                var popup = document.getElementById('popupMessage');
                popup.classList.add('show');
                
                // ซ่อน popup หลังจาก 3 วินาที
                setTimeout(function() {
                    popup.classList.remove('show');
                }, 3000); // 3000 ms = 3 วินาที
            });
        </script>
    <?php endif; ?>
</body>

</html>