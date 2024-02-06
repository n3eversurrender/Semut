<?php
session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['is_customer'])) {
    // Jika tidak ada sesi email, arahkan ke halaman login
    header("Location: SignInCustomer.php");
    exit();
}

// Menggunakan koneksi dari inc.koneksi.php
include("inc.koneksi.php");

if (isset($_POST['submit'])) {
    // Ambil data formulir
    $nama_barang = $_POST['nama_barang'];
    $alamat_penjemputan = $_POST['alamat_penjemputan'];
    $alamat_penerima = $_POST['alamat_penerima'];
    $no_telepon = $_POST['no_telepon'];
    $berat = $_POST['berat'];
    $jarak = $_POST['jarak'];
    $transportasi = $_POST['transportasi'];

    // Menangani unggah berkas
    $file_tmp = $_FILES['foto']['tmp_name'];

    // Baca berkas sebagai byte
    $berkas_content = file_get_contents($file_tmp);

    // Pilihan layanan kurir (terjadwal atau cepat)
    $layanan_kurir = $_POST['layanan_kurir'];

    // Tanggal terjadwal (jika Layanan Terjadwal dipilih)
    $tanggal_terjadwal = ($layanan_kurir === 'terjadwal') ? $_POST['tanggal_terjadwal'] : null;

    // Ganti nilai status menjadi "checking"
    $status = "1";

    // Ganti nilai status_pembayaran menjadi "pending"
    $status_pembayaran = "0";

    // Retrieve 'email' from the session
    $email = $_SESSION['email']; // Assuming you store the user's email in the session

    // Harga yang dihitung dari formulir
    $harga = $_POST['harga'];

    // Masukkan data ke tabel 'order' dengan menyimpan berkas sebagai BLOB
    $sql = "INSERT INTO `order` (email, nama_barang, alamat_penjemputan, alamat_penerima, no_telepon, berat, jarak, transportasi, foto, layanan_kurir, tanggal_terjadwal, status, status_pembayaran, harga) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Persiapkan pernyataan SQL
    $stmt = mysqli_prepare($koneksi, $sql);

    // Bind parameter berkas dan lainnya
    mysqli_stmt_bind_param($stmt, 'ssssssssssssss', $email, $nama_barang, $alamat_penjemputan, $alamat_penerima, $no_telepon, $berat, $jarak, $transportasi, $berkas_content, $layanan_kurir, $tanggal_terjadwal, $status, $status_pembayaran, $harga);

    // Eksekusi pernyataan SQL
    if (mysqli_stmt_execute($stmt)) {
        // Pemesanan berhasil dikonfirmasi, arahkan ke halaman Order_Status.php
        header("Location: Order_Status.php?success=true");
        exit(); // Pastikan tidak ada output lebih lanjut setelah header
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    // Menutup koneksi database
    mysqli_close($koneksi);
}
?>
