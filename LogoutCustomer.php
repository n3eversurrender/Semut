<?php
// Mulai atau lanjutkan sesi
session_start();

// Periksa apakah pengguna telah login
if (!isset($_SESSION['email'])) {

    exit();
}

// Hapus sesi
session_unset();
session_destroy();

// Alihkan ke halaman login
header("Location: SignInCustomer.php");
exit();
?>
