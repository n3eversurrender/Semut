<?php
include("inc.koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Pemeriksaan apakah ada file yang diunggah
    if (isset($_FILES['editBuktiPembayaran']) && $_FILES['editBuktiPembayaran']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Ada file yang diunggah

        // Ambil informasi dari formulir edit
        $buktiPembayaran = $_FILES['editBuktiPembayaran'];

        // Proses informasi file
        $namaFile = $buktiPembayaran['name'];
        $ukuranFile = $buktiPembayaran['size'];
        $tmpFile = $buktiPembayaran['tmp_name'];

        // Baca isi file sebagai BLOB
        $buktiPembayaranBlob = addslashes(file_get_contents($tmpFile));

        // Update status pembayaran dan status di tabel order
        $sql = "UPDATE `order` SET 
                    bukti_pembayaran = '$buktiPembayaranBlob',
                    status_pembayaran = 1,
                    status = 2
                WHERE Id = $orderId";
        mysqli_query($koneksi, $sql);

        // Redirect atau lakukan aksi lain setelah pembaruan berhasil
        header("Location: Order_Status.php");
        exit();
    } else {
        // Tidak ada file yang diunggah, handle sesuai kebutuhan
        echo "Tidak ada file yang diunggah.";
    }
}

mysqli_close($koneksi);
?>
