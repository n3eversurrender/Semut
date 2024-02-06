<?php
include("inc.koneksi.php");

$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : null;

function getStatusText($status)
{
    switch ($status) {
        case 1:
            return "Checking";
        case 2:
            return "Delivery";
        case 3:
            return "Complete";
        case 4:
            return "Cancel";
        default:
            return "Undefined";
    }
}

function getStatusPembayaranText($statusPembayaran)
{
    switch ($statusPembayaran) {
        case 0:
            return "Pending";
        case 1:
            return "Payment";
        default:
            return "Undefined";
    }
}

if ($orderId) {
    $sql = "SELECT * FROM `order` WHERE Id = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "i", $orderId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($order = mysqli_fetch_assoc($result)) {
        // Membuat konten resi pembayaran
        $resiContent = "Nomor Order: " . $order['Id'] . "\n";
        $resiContent .= "Nama Barang: " . $order['nama_barang'] . "\n";
        $resiContent .= "Email: " . $order['email'] . "\n";
        $resiContent .= "No Telepon: " . $order['no_telepon'] . "\n";
        $resiContent .= "Status Order: " . getStatusText($order['status']) . "\n";
        $resiContent .= "Status Pembayaran: " . getStatusPembayaranText($order['status_pembayaran']) . "\n";
        $resiContent .= "Harga: Rp." . number_format($order['harga'], 0, '.', '.') . "\n";

        // Tambahkan tanggal dan waktu unduh
        $resiContent .= "Datetime: " . date('Y-m-d H:i:s') . "\n";

        // Set header untuk tautan unduhan
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="resi_pembayaran_' . $orderId . '.txt"');

        // Keluarkan konten resi sebagai respons
        echo $resiContent;
    } else {
        echo "Order tidak ditemukan.";
    }

    mysqli_close($koneksi);
} else {
    echo "Parameter orderId tidak valid.";
}
?>
