<?php
$host     = "127.0.0.1";
$user     = "root";
$pass     = "";
$db       = "semut";

$koneksi  = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Gagal");
} else {
    // echo "Berhasil";
}
