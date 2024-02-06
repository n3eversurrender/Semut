<?php
session_start(); // Mulai sesi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("inc.koneksi.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mengambil data pelanggan berdasarkan email
    $sql = "SELECT * FROM customer WHERE Email = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();

    if ($customer) {
        if (password_verify($password, $customer['Password'])) {
            // Kata sandi cocok, pelanggan berhasil login
            // Setel sesi email
            $_SESSION['email'] = $email;
            $_SESSION['is_customer'] = true;
            header("Location: Home.php"); // Sesuaikan dengan halaman utama pelanggan Anda
            exit();
        } else {
            echo "<script>alert('Kata sandi salah.');</script>";
            header("Location:SignInCustomer.php");
        }
    } else {
        echo "<script>alert('Email tidak ditemukan.');</script>";
        header("Location:SignInCustomer.php");
    }

    $stmt->close();
}
?>