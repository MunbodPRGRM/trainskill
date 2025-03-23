<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            padding-top: 20px;
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
            height: 530px;
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
            height: 530px;
            width: 100%;
            background: white;
            padding: 30px;
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
            font-size: 16px;
        }

        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: linear-gradient(to right, rgb(100, 169, 212), rgb(99, 152, 227));
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            height: 530px;
            width: 100%;
            justify-content: center;
        }

        .profile-picture {
            width: 160px;
            /* กำหนดขนาดความกว้าง */
            height: 160px;
            /* กำหนดขนาดความสูง */
            border-radius: 50%;
            /* ให้เป็นวงกลม */
            border: 2px solid rgb(255, 255, 255);
            object-fit: cover;
            /* ควบคุมไม่ให้รูปผิดสัดส่วน */
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-section {
            text-align: center;
            color: white;
            font-size: 12px;
        }

        img.rounded-circle {
            object-fit: cover;
        }

        .password-container {
            position: relative;
            width: 100%;
        }

        .password-container input {
            width: 100%;
            padding-right: 40px;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: gray;
        }

        @media (max-width: 766px) {
            .container {
                flex-direction: column;
                /* จัดวางให้เป็นแนวตั้ง */
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
                width: 120px;
                /* ปรับขนาดรูปโปรไฟล์ให้พอดี */
                height: 120px;
            }

            .form .column {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }
        }

        @media (min-width: 767px) and (max-width: 992px) {
            .profile-container {
                width: 100%;
                height: 570px;
            }

            .form-container {
                width: 100%;
                height: 570px;
                padding: 20px;
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
        }
    </style>
</head>

<?php
if (isset($_SESSION['error'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด!',
                text: '" . $_SESSION['error'] . "',
                confirmButtonText: 'ตกลง',
                customClass: { confirmButton: 'btn btn-danger' },
                buttonsStyling: false
            });
        });
    </script>";
    unset($_SESSION['error']);
}
?>

<body style="background-color:rgb(236, 235, 235);">
    <section class="container">
        <div class="profile-container d-flex justify-content-center align-items-center">
            <p>ใส่รูปตรงนี้</p>
            <label for="profile_picture">
                <img src="<?= $data['result']['profile_image'] ?>" class="profile-picture" id="preview">
            </label>
        </div>
        </div>

        <div class="form-container">
            <header>Registration Form</header>
            <form class="form" action="/profile_edit" method="post" enctype="multipart/form-data">
                <input class="d-none" type="file" id="profile_picture" name="profile_picture" accept="image/jpeg, image/png, image/gif" onchange="preview(event)">
                <div class="input-box">
                    <label for="user_name">ชื่อผู้ใช้</label>
                    <input type="text" id="user_name" name="user_name" value="<?= $data['result']['user_name'] ?>" required>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="phone_number">เบอร์โทรศัพท์</label>
                        <input type="telephone" id="phone_number" name="phone_number" value="<?= $data['result']['phone_number'] ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="birthday">วันเกิด</label>
                        <input type="date" id="birthday" name="birthday" value="<?= $data['result']['birthday'] ?>" required>
                    </div>
                </div>
                <div class="gender-box">
                    <label for="gender">Gender</label>
                    <div class="gender-option justify-content-center">
                        <div class="gender">
                            <input name="gender" id="check-male" type="radio" value="male"
                                <?= $data['result']['gender'] && $data['result']['gender'] == 'male' ? 'checked' : '' ?>>
                            <label for="check-male">ชาย</label>
                        </div>
                        <div class="gender">
                            <input name="gender" id="check-female" type="radio" value="female"
                                <?= $data['result']['gender'] && $data['result']['gender'] == 'female' ? 'checked' : '' ?>>
                            <label for="check-female">หญิง</label>
                        </div>
                        <div class="gender">
                            <input name="gender" id="check-other" type="radio" value="unknown"
                                <?= $data['result']['gender'] && $data['result']['gender'] == 'unknown' ? 'checked' : '' ?>>
                            <label for="check-other">ไม่ระบุ</label>
                        </div>
                    </div>
                </div>
                <div class="input-box">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="รหัสผ่านใหม่" class="form-control">
                        <i class="fa fa-eye eye-icon" id="eyeIcon1"></i>
                    </div>
                </div>
                <div class="input-box">
                    <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน</label>
                    <div class="password-container">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่านใหม่" class="form-control">
                        <i class="fa fa-eye eye-icon" id="eyeIcon2"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary w-100">แก้ไขข้อมูล</button>
                </div>
            </form>
        </div>
    </section>

    <script src="public/script.js"></script>
    <script>
        function togglePassword(inputId, eyeIconId) {
            let passwordInput = document.getElementById(inputId);
            let eyeIcon = document.getElementById(eyeIconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text"; // แสดงรหัสผ่าน
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash"); // เปลี่ยนไอคอนเป็นซ่อน
            } else {
                passwordInput.type = "password"; // ซ่อนรหัสผ่าน
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye"); // เปลี่ยนไอคอนเป็นแสดง
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            console.log("JavaScript Loaded"); // เช็คว่า JS โหลดหรือไม่

            function togglePassword(inputId, eyeIconId) {
                let passwordInput = document.getElementById(inputId);
                let eyeIcon = document.getElementById(eyeIconId);

                if (!passwordInput || !eyeIcon) {
                    console.log("Error: ไม่พบ element ที่กำหนด");
                    return;
                }

                console.log("Toggle password:", inputId);

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                } else {
                    passwordInput.type = "password";
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                }
            }

            let eyeIcon1 = document.getElementById("eyeIcon1");
            let eyeIcon2 = document.getElementById("eyeIcon2");

            if (eyeIcon1) {
                eyeIcon1.addEventListener("click", function() {
                    togglePassword("password", "eyeIcon1");
                });
            } else {
                console.log("Error: ไม่พบ eyeIcon1");
            }

            if (eyeIcon2) {
                eyeIcon2.addEventListener("click", function() {
                    togglePassword("confirm_password", "eyeIcon2");
                });
            } else {
                console.log("Error: ไม่พบ eyeIcon2");
            }
        });
    </script>

</body>