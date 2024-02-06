<?php

// Pastikan bahwa formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sertakan file koneksi
    include("inc.koneksi.php");

    // Ambil data dari formulir dan hindari SQL injection
    $kurirId = mysqli_real_escape_string($koneksi, $_POST['kurirId']);
    $editKurirNama = mysqli_real_escape_string($koneksi, $_POST['editKurirNama']);
    $editKurirAlamat = mysqli_real_escape_string($koneksi, $_POST['editKurirAlamat']);
    $editKurirNo_Telepon = mysqli_real_escape_string($koneksi, $_POST['editKurirNo_Telepon']);
    $editKurirStatus = mysqli_real_escape_string($koneksi, $_POST['editKurirStatus']);
    $editKurirModel = mysqli_real_escape_string($koneksi, $_POST['editKurirModel']);

    // Update data kurir di database
    $sqlUpdate = "UPDATE `kurir` SET 
                  `Nama`='$editKurirNama',
                  `Alamat`='$editKurirAlamat',
                  `Status`='$editKurirStatus',
                  `Model`='$editKurirModel'
                  WHERE `Id`='$kurirId'";

    $queryUpdate = mysqli_query($koneksi, $sqlUpdate);

    // Periksa apakah query berhasil dijalankan
    if ($queryUpdate) {
        // Redirect ke halaman admin dengan pesan sukses
        header("Location: DataKurir.php?edit=success");
        exit();
    } else {
        // Redirect ke halaman admin dengan pesan error
        header("Location: DataKurir.php?edit=error");
        exit();
    }

    // Tutup koneksi database (unreachable code, removed)
    // mysqli_close($koneksi);
} else {
    // Jika formulir tidak disubmit, redirect ke halaman admin
    header("Location: DataKurir.php");
    exit();
}
?>
