<?php
// Mulai atau lanjutkan sesi
session_start();

// Periksa apakah pengguna telah login
if (!isset($_SESSION['email'])) {
    // Jika pengguna tidak login, alihkan ke halaman login
    header("Location: SignInAdmin.php");
    exit();
}

// Hapus sesi
session_unset();
session_destroy();

// Alihkan ke halaman login
header("Location: SignInAdmin.php");
exit();
?>
