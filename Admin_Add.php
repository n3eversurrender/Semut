<?php
include("inc.koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $nama = $_POST['addAdminNama'];
    $alamat = $_POST['addAdminAlamat'];
    $email = $_POST['addAdminEmail'];
    $password = $_POST['addAdminPassword'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashing password
    $status = 1;
    $role = 1;
    $position = 0;

    // Perform SQL query to insert data into the database
    $sql = "INSERT INTO `admin` (Nama, Alamat, Email, Password, Status, Role, Position) VALUES ('$nama', '$alamat', '$email', '$hashed_password', '$status', '$role', '$position')";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        // Redirect to the page after successful insertion
        header("Location: DataAdmin.php");
        exit();
    } else {
        // Handle error, you can customize this based on your needs
        echo "Error: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
