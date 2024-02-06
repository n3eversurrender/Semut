<?php
include("inc.koneksi.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $orderId = $_GET['id'];

    // Perform the delete operation
    $deleteSql = "DELETE FROM `order` WHERE Id = $orderId";
    $deleteResult = mysqli_query($koneksi, $deleteSql);

    if ($deleteResult) {
        // Redirect back to Order_Status.php after successful deletion
        header("Location: Order_Status.php");
        exit();
    } else {
        die("Error: Unable to delete order - " . mysqli_error($koneksi));
    }
} else {
    // Invalid or missing order ID
    die("Invalid or missing order ID");
}
?>
