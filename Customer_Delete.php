<?php
include("inc.koneksi.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $customerId = $_GET['id'];

    $sql = "DELETE FROM customer WHERE Id = $customerId";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: DataCustomer.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
} else {
    echo "Invalid ID or ID not provided.";
}
?>
