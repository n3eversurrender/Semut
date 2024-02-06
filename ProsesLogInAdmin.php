<?php
session_start(); // Mulai sesi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("inc.koneksi.php");
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mengambil data admin berdasarkan email
    $sql = "SELECT * FROM admin WHERE Email = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin) {
        if ($admin['Status'] == 0) {
            // Status unactive, redirect with a message
            header("Location: SignInAdmin.php?status=unactive");
            exit();
        }
        if (password_verify($password, $admin['Password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['is_admin'] = true;
            header("Location: Dashboard.php");
            exit();
        } else {
            echo "<script>alert('Kata sandi salah.');</script>";
            header("SignInAdmin.php");
        }
    } else {
        echo "<script>alert('Email tidak ditemukan.');</script>";
        header("SignInAdmin.php");
    }

    $stmt->close();
}
?>
