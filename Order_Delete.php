<?php
include("inc.koneksi.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $orderId = $_GET['id'];

    $sql = "DELETE FROM `order` WHERE Id = $orderId";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: DataOrderKonfirmasi.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
} else {
    echo "Invalid ID or ID not provided.";
}
?>
