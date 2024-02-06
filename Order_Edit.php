<?php
session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['is_admin'])) {
    header("Location: SignInAdmin.php");
    exit();
}

include("inc.koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve edited status from the form
    $orderId = $_POST['orderId']; // Make sure you have an input field for order ID in your form
    $editedStatus = $_POST['editStatus'];

    // Update the status in the database
    $updateSql = "UPDATE `order` SET `status` = '$editedStatus' WHERE `Id` = '$orderId'";
    $updateQuery = mysqli_query($koneksi, $updateSql);

    if ($updateQuery) {
        // Redirect to the page showing the updated orders
        header("Location: DataOrderKonfirmasi.php");
        exit();
    } else {
        // Handle the case where the update fails
        echo "Error updating order status: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
