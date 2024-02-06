<?php
include("inc.koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $nama = $_POST['addHargaNama'];
    $harga = $_POST['addHarga'];

    // Perform SQL query to insert data into the database
    $sql = "INSERT INTO `harga_jasa` (nama, harga) VALUES ('$nama', '$harga')";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        // Redirect to the page after successful insertion
        header("Location: DataHarga.php");
        exit();
    } else {
        // Handle error, you can customize this based on your needs
        echo "Error: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
