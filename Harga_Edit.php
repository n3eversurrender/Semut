<?php

// Pastikan bahwa formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sertakan file koneksi
    include("inc.koneksi.php");

    // Ambil data dari formulir dan hindari SQL injection
    $hargaId = mysqli_real_escape_string($koneksi, $_POST['hargaId']);
    $editHargaNama = mysqli_real_escape_string($koneksi, $_POST['editHargaNama']);
    $editHarga = mysqli_real_escape_string($koneksi, $_POST['editHarga']);

    // Update data admin di database
    $sqlUpdate = "UPDATE `harga_jasa` SET 
                  `nama`='$editHargaNama',
                  `harga`='$editHarga'
                  WHERE `Id`='$hargaId'";

    $queryUpdate = mysqli_query($koneksi, $sqlUpdate);

    // Periksa apakah query berhasil dijalankan
    if ($queryUpdate) {
        // Redirect ke halaman admin dengan pesan sukses
        header("Location: DataHarga.php?edit=success");
        exit();
    } else {
        // Redirect ke halaman admin dengan pesan error
        header("Location: DataHarga.php?edit=error");
        exit();
    }

} else {
    header("Location: Dataharga.php");
    exit();
}
?>
