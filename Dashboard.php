<?php
session_start(); // Mulai sesi

// Periksa apakah pengguna sudah masuk (sesi email sudah ada)
if (!isset($_SESSION['email']) or !isset($_SESSION['is_admin'])) {
    // Jika tidak ada sesi email, arahkan ke halaman login
    header("Location: SignInAdmin.php");
    exit();
}

// Dapatkan email pengguna dari sesi
$email = $_SESSION['email'];

// Buat koneksi ke database
include("inc.koneksi.php");

// Query database untuk mendapatkan nama pengguna berdasarkan email
$sqlNama = "SELECT Nama FROM `admin` WHERE email = '$email'";
$resultNama = mysqli_query($koneksi, $sqlNama);

// Query untuk mendapatkan total admin dari tabel admin
$sqlTotalAdmin = "SELECT COUNT(*) AS totalAdmin FROM `admin`";
$resultTotalAdmin = mysqli_query($koneksi, $sqlTotalAdmin);
$rowTotalAdmin = mysqli_fetch_assoc($resultTotalAdmin);
$totalAdmin = $rowTotalAdmin['totalAdmin'];

// Query untuk mendapatkan total order dari tabel order
$sqlTotalOrder = "SELECT COUNT(*) AS totalOrder FROM `order`";
$resultTotalOrder = mysqli_query($koneksi, $sqlTotalOrder);
$rowTotalOrder = mysqli_fetch_assoc($resultTotalOrder);
$totalOrder = $rowTotalOrder['totalOrder'];

$sqlTotalHarga = "SELECT SUM(harga) AS totalHarga FROM `order`";
$resultTotalHarga = mysqli_query($koneksi, $sqlTotalHarga);
$rowTotalHarga = mysqli_fetch_assoc($resultTotalHarga);
$totalHarga = $rowTotalHarga['totalHarga'];

$sqlTotalKurir = "SELECT COUNT(*) AS totalKurir FROM `kurir`";
$resultTotalKurir = mysqli_query($koneksi, $sqlTotalKurir);
$rowTotalKurir = mysqli_fetch_assoc($resultTotalKurir);
$totalKurir = $rowTotalKurir['totalKurir'];

// Query untuk mendapatkan total customer dari tabel customer
$sqlTotalCustomer = "SELECT COUNT(*) AS totalCustomer FROM `customer`";
$resultTotalCustomer = mysqli_query($koneksi, $sqlTotalCustomer);
$rowTotalCustomer = mysqli_fetch_assoc($resultTotalCustomer);
$totalCustomer = $rowTotalCustomer['totalCustomer'];

$sqlTotalStay = "SELECT COUNT(*) AS totalStay FROM `kurir` WHERE status = 0";
$resultTotalStay = mysqli_query($koneksi, $sqlTotalStay);
$rowTotalStay = mysqli_fetch_assoc($resultTotalStay);
$totalStay = $rowTotalStay['totalStay'];

// Periksa apakah query berhasil dieksekusi
if ($rowNama = mysqli_fetch_assoc($resultNama)) {
    $Nama = $rowNama['Nama'];
} else {
    $Nama = "Nama Pengguna Tidak Ditemukan";
}

// Tutup koneksi setelah selesai menggunakan database
mysqli_close($koneksi);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <style>
        /* Gaya kustom Anda */
        body {
            background-color: #eff1f3;
        }

        .sidebar {
            height: 100vh;
            background-color: #ffffff;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li a {
            display: block;
            padding: 10px;
            position: relative;
            color: #000000;
            text-decoration: none;
        }

        .text-submenu li a:hover {
            background-color: rgb(0, 0, 0);
            transition: 0.3s ease;
            color: white;
        }


        .sidebar ul li .arrow {
            position: absolute;
            right: 20px;
            transform: rotate(0deg);
            transition: transform 0.3s ease-in-out;
        }


        .sidebar ul li .toggle-submenu.active .arrow {
            transform: rotate(90deg);
        }

        .content {
            padding: 20px;
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
            font-size: 12px;
            margin-left: 20px;
        }

        .submenu a {
            text-decoration: none;
            color: #000;
        }


        .active {
            max-height: 500px;

        }

        .logo {
            margin: 20px 0;
        }

        .welcome-message {
            font-size: 16px;
        }

        .logout-text {
            display: block;
            position: absolute;
            bottom: 10px;

        }

        .logout-text a {
            color: #000000;
            text-decoration: none;
            right: 20px;
        }

        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            border-radius: 15px;
        }

        .card h5 {
            font-weight: bold;
            font-size: x-large;
        }

        .card p {
            font-size: small;
        }

        .btn-more-info {
            width: 100%;
            align-items: center;
            font-weight: bold;
            font-size: small;
            margin-top: 40px;
        }

        .btn-more-info:hover {
            background-color: #000000f7;
            color: #ffffff
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="mt-1 text-center">
                    <img src="Image/SEMUT LOGO.png" width="70%" alt="">
                </div>
                <ul class="text-submenu">
                    <li><a href="Dashboard.php"><i class="fa-brands fa-pix me-2"></i></i>Dashboard</a></li>
                    <li><a href="DataAdmin.php" class="toggle-submenu"><i class="fa-solid fa-layer-group me-2"></i>Admin
                            <i class="fa-solid fa-angle-right float-end arrow"></i></a>
                        <ul class="submenu">
                            <li><a href="DataAdmin.php">Data Admin</a></li>
                        </ul>
                    </li>
                    <li><a href="DataCustomer.php" class="toggle-submenu"><i
                                class="fa-solid fa-layer-group me-2"></i>Master Data<i
                                class="fa-solid fa-angle-right float-end arrow"></i></a>
                        <ul class="submenu">
                            <li><a href="DataCustomer.php">Data Customer</a></li>
                            <li><a href="DataKurir.php">Data Kurir</a></li>
                            <li><a href="DataHarga.php">Data Harga Jasa</a></li>
                            <li><a href="DataKendaran.php">Data Kendaraan</a></li>
                        </ul>
                    </li>
                    <li><a href="DataOrder.php" class="toggle-submenu"><i
                                class="fa-solid fa-layer-group me-2"></i>Order<i
                                class="fa-solid fa-angle-right float-end arrow"></i></a>
                        <ul class="submenu">
                            <li><a href="DataOrder.php">Daftar Order</a></li>
                            <li><a href="DataOrderKonfirmasi.php">Konfirmasi Order</a></li>
                            <li><a href="DataTransaksi.php">Daftar Transaksi</a></li>
                        </ul>
                    </li>
                    <div class="logout-text">
                        <a href="logout.php"><i class="fa-solid fa-right-from-bracket mx-2 me-2"></i>Logout</a>
                    </div>
                </ul>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
                <div class="welcome-message">
                    <h3>Selamat datang di Dashboard <strong>
                            <?php echo $Nama; ?>
                        </strong></h3>
                    <div class="container mt-4">
                        <div class="row">

                            <!-- Admin Card -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Admin</h5>
                                        <p class="card-text" style="position: relative;">
                                            <i class="fa-solid fa-users fa-7x"
                                                style="position: absolute; top: -30px; right: 25px;"></i>
                                            Total:
                                            <?php echo $totalAdmin; ?> Users
                                        </p>
                                        <a href="DataAdmin.php" class="btn btn-more-info">More Info</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Kurir Card -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Order</h5>
                                        <p class="card-text" style="position: relative;">
                                            <i class="fa-solid fa-people-carry-box fa-7x"
                                                style="position: absolute; top: -30px; right: 25px;"></i>
                                            Total:
                                            <?php echo $totalOrder; ?>
                                        </p>
                                        <a href="DataOrder.php" class="btn btn-more-info">More Info</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Pengeluaran Card -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Income</h5>
                                        <p class="card-text" style="position: relative;">
                                            <i class="fa-solid fa-file-invoice-dollar fa-7x"
                                                style="position: absolute; top: -30px; right: 25px;"></i>
                                            Total:
                                            <?php echo $totalHarga = "Rp. " . number_format($totalHarga, 0, ',', '.'); ?>
                                        </p>
                                        <a href="DataTransaksi.php" class="btn btn-more-info">More Info</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Card -->
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Customer</h5>
                                        <p class="card-text" style="position: relative;">
                                            <i class="fa-solid fa-users-line fa-7x"
                                                style="position: absolute; top: -30px; right: 25px;"></i>
                                            Total:
                                            <?php echo $totalCustomer; ?> Users
                                        </p>
                                        <a href="DataCustomer.php" class="btn btn-more-info">More Info</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Tarif Card -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Kendaraan</h5>
                                        <p class="card-text" style="position: relative;">
                                            <i class="fa-solid fas fa-car fa-7x"
                                                style="position: absolute; top: -30px; right: 25px;"></i>
                                            Total:
                                            <?php echo $totalStay; ?> Available
                                        </p>
                                        <a href="DataKendaran.php" class="btn btn-more-info">More Info</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Tarif Card -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Courier</h5>
                                        <p class="card-text" style="position: relative;">
                                            <i class="fa-solid fa-users-gear fa-7x"
                                                style="position: absolute; top: -30px; right: 25px;"></i>
                                            Total:
                                            <?php echo $totalKurir; ?> Users
                                        </p>
                                        <a href="DataKurir.php" class="btn btn-more-info">More Info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

<!-- Tambahkan tautan ke Bootstrap JavaScript (Opsional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Tambahkan fungsi untuk menampilkan/sembunyikan submenu
    const toggleSubmenu = document.querySelectorAll('.toggle-submenu');

    toggleSubmenu.forEach((menu) => {
        menu.addEventListener('click', function (e) {
            // Mencegah tindakan default dari tautan
            e.preventDefault();

            // Ambil semua submenu
            const submenus = document.querySelectorAll('.submenu');

            // Ambil ikon panah yang terletak di dalam menu
            const arrow = this.querySelector('.arrow');
            const submenu = this.nextElementSibling;

            // Tutup semua submenu terlebih dahulu, kecuali submenu yang sesuai dengan yang diklik
            submenus.forEach((sub) => {
                if (sub !== submenu) {
                    sub.classList.remove('active');
                }
            });

            // Toggle status submenu yang diklik
            submenu.classList.toggle('active');

            // Putar ikon panah 90 derajat saat submenu ditampilkan
            if (submenu.classList.contains('active')) {
                arrow.style.transform = 'rotate(90deg)';
            } else {
                arrow.style.transform = 'rotate(0deg)';
            }
        });
    });

    // Tambahkan fungsi untuk menutup submenu dengan mengklik panah
    const submenuArrow = document.querySelectorAll('.submenu .arrow');

    submenuArrow.forEach((arrow) => {
        arrow.addEventListener('click', function (e) {
            // Mencegah tindakan default dari panah
            e.preventDefault();

            // Tutup submenu yang sesuai dengan panah yang diklik
            const submenu = this.parentElement;
            submenu.classList.remove('active');

            // Setel kembali panah ke posisi semula
            this.style.transform = 'rotate(0deg)';
        });
    });
</script>

</html>