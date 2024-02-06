<?php
// set_notification_status.php

// Lakukan inisialisasi koneksi ke database atau sumber data lainnya jika diperlukan
include("inc.koneksi.php");

// Menerima data status dan orderId dari AJAX
$status = $_POST['status'];
$orderId = $_POST['orderId'];

// Misalnya, kita akan menyimpan status notifikasi pada tabel notifications_status
$sql = "INSERT INTO notifications_status (status, order_id) VALUES ('$status', '$orderId')";
$result = mysqli_query($koneksi, $sql);

// Periksa apakah query berhasil dijalankan
if ($result) {
    // Kirim respon ke JavaScript bahwa status notifikasi berhasil disimpan
    echo json_encode(['success' => true]);
} else {
    // Kirim respon ke JavaScript bahwa terjadi kesalahan
    echo json_encode(['success' => false, 'error' => mysqli_error($koneksi)]);
}

// Tutup koneksi ke database jika diperlukan
mysqli_close($koneksi);
?>
