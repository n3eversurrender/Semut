<?php
include("inc.koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Periksa apakah kata sandi dan konfirmasi kata sandi sesuai
    if ($password !== $konfirmasi_password) {
        echo "Kata sandi dan konfirmasi kata sandi tidak cocok.";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO customer (nama, alamat, email, no_telepon, jenis_kelamin, password) VALUES ('$nama', '$alamat', '$email', '$no_telepon', '$jenis_kelamin', '$hashed_password')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Selamat Anda Berhasil Registrasi, silahkan untuk login.');</script>";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'SignInCustomer.php';
            }, 1000); // 1000 milliseconds (1 seconds)
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Permintaan tidak valid.";
}

mysqli_close($koneksi);
?>
