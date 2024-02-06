<?php
session_start();
if (!isset($_SESSION['email']) or !isset($_SESSION['is_admin'])) {
    header("Location: SignInAdmin.php");
    exit();
}

include("inc.koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua data yang diterima bersih dari potensi serangan SQL Injection
    $customerId = mysqli_real_escape_string($koneksi, $_POST['customerId']);
    $editNama = mysqli_real_escape_string($koneksi, $_POST['editNama']);
    $editAlamat = mysqli_real_escape_string($koneksi, $_POST['editAlamat']);
    $editEmail = mysqli_real_escape_string($koneksi, $_POST['editEmail']);
    $editNoTelepon = mysqli_real_escape_string($koneksi, $_POST['editNoTelepon']);
    $editJenisKelamin = mysqli_real_escape_string($koneksi, $_POST['editJenisKelamin']);

    // Query untuk melakukan update data customer
    $updateSql = "UPDATE `customer` SET 
                  `Nama` = '$editNama',
                  `Alamat` = '$editAlamat',
                  `Email` = '$editEmail',
                  `No_Telepon` = '$editNoTelepon',
                  `Jenis_Kelamin` = '$editJenisKelamin'
                  WHERE `Id` = '$customerId'";

    $result = mysqli_query($koneksi, $updateSql);

    if ($result) {
        // Jika berhasil diupdate, arahkan kembali ke halaman DataCustomer.php
        header("Location: DataCustomer.php");
        exit();
    } else {
        // Jika gagal, munculkan pesan error atau lakukan penanganan yang sesuai
        echo "Gagal mengupdate data customer: " . mysqli_error($koneksi);
    }
} else {
    // Jika akses bukan melalui POST request, redirect ke halaman utama
    header("Location: DataCustomer.php");
    exit();
}

mysqli_close($koneksi);
?>
