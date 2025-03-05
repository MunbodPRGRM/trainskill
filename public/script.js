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