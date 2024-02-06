<?php

// Pastikan bahwa formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sertakan file koneksi
    include("inc.koneksi.php");

    // Ambil data dari formulir dan hindari SQL injection
    $adminId = mysqli_real_escape_string($koneksi, $_POST['adminId']);
    $editAdminNama = mysqli_real_escape_string($koneksi, $_POST['editAdminNama']);
    $editAdminAlamat = mysqli_real_escape_string($koneksi, $_POST['editAdminAlamat']);
    $editAdminEmail = mysqli_real_escape_string($koneksi, $_POST['editAdminEmail']);
    $editAdminStatus = mysqli_real_escape_string($koneksi, $_POST['editAdminStatus']);
    $editAdminPosition = mysqli_real_escape_string($koneksi, $_POST['editAdminPosition']);

    // Update data admin di database
    $sqlUpdate = "UPDATE `admin` SET 
                  `Nama`='$editAdminNama',
                  `Alamat`='$editAdminAlamat',
                  `Status`='$editAdminStatus',
                  `Position`='$editAdminPosition'
                  WHERE `Id`='$adminId'";

    $queryUpdate = mysqli_query($koneksi, $sqlUpdate);

    // Periksa apakah query berhasil dijalankan
    if ($queryUpdate) {
        // Redirect ke halaman admin dengan pesan sukses
        header("Location: DataAdmin.php?edit=success");
        exit();
    } else {
        // Redirect ke halaman admin dengan pesan error
        header("Location: DataAdmin.php?edit=error");
        exit();
    }

    // Tutup koneksi database (unreachable code, removed)
    // mysqli_close($koneksi);
} else {
    // Jika formulir tidak disubmit, redirect ke halaman admin
    header("Location: DataAdmin.php");
    exit();
}
?>
