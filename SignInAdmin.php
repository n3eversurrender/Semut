<?php
session_start(); // Mulai sesi

// Check for the status parameter in the URL
$status = isset($_GET['status']) ? $_GET['status'] : '';

if ($status == 'unactive') {
    echo "<script>alert('Status email Anda Unactive. Silakan hubungi administrator.');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('Image/Background.jpg'); /* Ganti dengan URL gambar latar belakang Anda */
            background-size: cover;
            background-attachment: fixed;
            background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang transparan */
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.800); /* Latar belakang transparan untuk kotak form */
            padding: 20px;
            border-radius: 10px;
        }

        /* CSS untuk menempatkan "Forgot Password" di sebelah kanan card */
        .forgot-password {  
            font-size: 13px;
        }

        .register-now {
            margin-top: 20px; /* Atur sesuai kebutuhan Anda */
            font-size: 14px;
        }

        /* CSS untuk menyesuaikan lebar tombol "Login" dengan input "Username" */
        .btn {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-title text-center">Login Admin</h5>
                <form action="ProsesLogInAdmin.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                    <br><a class="forgot-password" href="#">Forgot Password?</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan link ke Bootstrap JS dan Popper.js (jika diperlukan) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
