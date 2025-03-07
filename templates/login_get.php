<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSkill-เข้าสู่ระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #d3d3d3, #1e3c72);
        }

        @media (max-width: 768px) {
            .card {
                width: 50%;
                padding: 30px;
            }
        }

        @media (max-width: 992px) {
            .card {
                width: 310px; 
            }
        }

        @media (min-width: 992px) {
            .card {
                width: 350px; 
            }
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg">
        <h3 class="text-center mb-3">LOGIN TO YOUR ACCOUNT</h3>
        <form action="/login" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">LOGIN</button>
        </form>
        <p class="text-center mt-3">Don't have an account? <a href="/register">Sign up now</a></p>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success mt-2">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
