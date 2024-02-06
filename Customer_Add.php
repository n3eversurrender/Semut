<?php
if (isset($_POST['simpan'])) {
    include("inc.koneksi.php");

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $sql = "INSERT INTO customer (Nama, Alamat, Email, No_Telepon, Jenis_Kelamin) VALUES ('$nama', '$alamat', '$email', '$no_telepon', '$jenis_kelamin')";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: DataCustomer.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
