document.addEventListener("DOMContentLoaded", function() {
    var currentPath = window.location.pathname; // ดึง URL ปัจจุบัน
    var navLinks = document.querySelectorAll(".nav-link"); // ค้นหาเมนูทั้งหมด

    navLinks.forEach(link => {
        if (link.getAttribute("href") === currentPath) {
                link.classList.add("active");
        }
    });
});

function confirmDelete() {
    return confirm("คุณแน่ใจแล้วใช่ไหมที่จะลบกิจกรรมนี้?");
}

function confirmAlright() {
    return confirm("คุณแน่ใจแล้วใช่ไหมที่จะกดยอมรับ?");
}

function confirmReject() {
    return confirm("คุณแน่ใจแล้วใช่ไหมที่จะกดปฏิเสธ?");
}

function previewImage(input, previewId) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgElement = document.getElementById(previewId);
            imgElement.src = e.target.result;
            imgElement.classList.remove('d-none'); 
        };
        reader.readAsDataURL(file);
    }
}

function preview(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function togglePassword(inputId, eyeIconId) {
    let passwordInput = document.getElementById(inputId);
    let eyeIcon = document.getElementById(eyeIconId);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";  // แสดงรหัสผ่าน
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash"); // เปลี่ยนไอคอนเป็นซ่อน
    } else {
        passwordInput.type = "password"; // ซ่อนรหัสผ่าน
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye"); // เปลี่ยนไอคอนเป็นแสดง
    }
}

document.addEventListener("DOMContentLoaded", function () {
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
        eyeIcon1.addEventListener("click", function () {
            togglePassword("password", "eyeIcon1");
        });
    } else {
        console.log("Error: ไม่พบ eyeIcon1");
    }

    if (eyeIcon2) {
        eyeIcon2.addEventListener("click", function () {
            togglePassword("confirm_password", "eyeIcon2");
        });
    } else {
        console.log("Error: ไม่พบ eyeIcon2");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    var popup = document.getElementById('popupMessage');
    
    if (popup) { // ตรวจสอบว่ามี popup หรือไม่
        popup.classList.add('show');
        
        setTimeout(function () {
            popup.classList.remove('show');
        }, 3000);
    }
});

console.log("ถ้ายังกวนตีนไม่เลิก กูตามล่ามึงแน่");