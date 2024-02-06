<?php
include("inc.koneksi.php");

session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['is_customer'])) {
    // Jika tidak ada sesi email, kembalikan nilai 0
    echo 0;
    exit();
}

$email = $_SESSION['email'];

// Hitung jumlah pesanan yang memiliki status selesai
$sql = "SELECT COUNT(*) as count FROM `order` WHERE email = '$email' AND status = 3";
$query = mysqli_query($koneksi, $sql);
$result = mysqli_fetch_assoc($query);

echo $result['count'];
?>
