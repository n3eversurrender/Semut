<?php
include("inc.koneksi.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM admin WHERE Id = $id";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: DataAdmin.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
} else {
    echo "Invalid ID or ID not provided.";
}
?>
