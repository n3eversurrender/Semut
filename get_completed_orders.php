<?php
include("inc.koneksi.php");

session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['is_customer'])) {
    // Jika tidak ada sesi email, keluar
    exit();
}

$email = $_SESSION['email'];

// Ambil daftar pesanan yang memiliki status selesai
$sql = "SELECT * FROM `order` WHERE email = '$email' AND status = 3";
$query = mysqli_query($koneksi, $sql);

// Tampilkan daftar pesanan
while ($order = mysqli_fetch_array($query)) {
    echo "<div>Pesanan ID " . $order['Id'] . " Telah Berhasil Di Antarkan.</div>";
}
?>
