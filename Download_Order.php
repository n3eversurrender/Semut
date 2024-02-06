<?php
include("inc.koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query database untuk mengambil data blob gambar berdasarkan ID
    $sql = "SELECT foto FROM `order` WHERE Id = ?";

    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $image);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Set header untuk jenis berkas gambar
    header("Content-Type: image/jpeg"); // Ubah sesuai jenis gambar yang sesuai

    // Set header untuk tampilan unduhan
    header("Content-Disposition: attachment; filename=downloaded_image.jpg"); // Ubah nama file jika diperlukan

    // Keluarkan data blob gambar
    echo $image;
}
mysqli_close($koneksi);
?>
