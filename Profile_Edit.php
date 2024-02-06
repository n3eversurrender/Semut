<?php
session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['is_customer'])) {
    // Jika tidak ada sesi email, arahkan ke halaman login
    header("Location: SignInCustomer.php");
    exit();
}

// Dapatkan email pengguna dari sesi
$email = $_SESSION['email'];

// Fetch user data from the database
include("inc.koneksi.php");
$sql = "SELECT * FROM `customer` WHERE `email` = '$email'";
$query = mysqli_query($koneksi, $sql);

// Check if the query was successful
if ($query) {
    $user = mysqli_fetch_assoc($query);
} else {
    echo "Error in fetching user data: " . mysqli_error($koneksi);
    exit();
}

// Proses pembaruan data profil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newNama = $_POST['editNama'];
    $newNoTelepon = $_POST['editNoTelepon'];
    $newAlamat = $_POST['editAlamat'];
    $newJenisKelamin = $_POST['editJenisKelamin'];

    // Update data profil
    $updateSql = "UPDATE `customer` SET `Nama`='$newNama', `No_Telepon`='$newNoTelepon', `Alamat`='$newAlamat', `Jenis_Kelamin`='$newJenisKelamin' WHERE `email`='$email'";
    $updateQuery = mysqli_query($koneksi, $updateSql);

    if (!$updateQuery) {
        echo "Error updating user data: " . mysqli_error($koneksi);
        exit();
    }

    // Proses pembaruan foto profil jika dipilih
    if (!empty($_FILES['changeProfilePicture']['name'])) {
        $fotoProfil = addslashes(file_get_contents($_FILES['changeProfilePicture']['tmp_name']));

        $updateFotoSql = "UPDATE `customer` SET `Foto`='$fotoProfil' WHERE `email`='$email'";
        $updateFotoQuery = mysqli_query($koneksi, $updateFotoSql);

        if (!$updateFotoQuery) {
            echo "Error updating profile picture: " . mysqli_error($koneksi);
            exit();
        }
    }

    // Redirect ke halaman profil setelah pembaruan
    header("Location: Profile.php");
    exit();
}


var_dump($_POST);  // Cek data POST
var_dump($_FILES); // Cek data FILES

// Close the database connection
mysqli_close($koneksi);
?>
