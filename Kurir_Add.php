<?php
include("inc.koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $nama = $_POST['addKurirNama'];
    $alamat = $_POST['addKurirAlamat'];
    $no_telepon = $_POST['addKurirNo_Telepon'];
    $model = $_POST['addKurirModel'];
    $jenis_kendaraan = $_POST['addKurirJenis_Kendaraan'];
    $warna = $_POST['addKurirWarna'];
    $nomor_plat = $_POST['addKurirNomor_Plat'];

    // Perform SQL query to insert data into the database
    $sql = "INSERT INTO `kurir` (nama, alamat, no_telepon, model, jenis_kendaraan, warna, nomor_plat) VALUES ('$nama', '$alamat', '$no_telepon', '$model', '$jenis_kendaraan', '$warna', '$nomor_plat')";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        // Redirect to the page after successful insertion
        header("Location: DataKurir.php");
        exit();
    } else {
        // Handle error, you can customize this based on your needs
        echo "Error: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>