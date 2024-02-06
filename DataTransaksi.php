<?php
session_start(); // Mulai sesi

// Periksa apakah pengguna sudah masuk (sesi email sudah ada)
if(!isset($_SESSION['email']) or !isset($_SESSION['is_admin'])) {
    // Jika tidak ada sesi email, arahkan ke halaman login
    header("Location: SignInAdmin.php");
    exit();
}

// Dapatkan email pengguna dari sesi
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="Admin.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="mt-1 text-center">
                    <img src="Image/SEMUT Logo.png" width="70%" alt="">
                </div>
                <ul class="text-submenu">
                    <li><a href="Dashboard.php"><i class="fa-brands fa-pix me-2"></i></i>Dashboard</a></li>
                    <li><a href="#" class="toggle-submenu"><i class="fa-solid fa-layer-group me-2"></i>Admin <i
                                class="fa-solid fa-angle-right float-end arrow"></i></a>
                        <ul class="submenu">
                            <li><a href="DataAdmin.php">Data Admin</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="toggle-submenu"><i class="fa-solid fa-layer-group me-2"></i>Master Data<i
                                class="fa-solid fa-angle-right float-end arrow"></i></a>
                        <ul class="submenu">
                            <li><a href="DataCustomer.php">Data Customer</a></li>
                            <li><a href="DataKurir.php">Data Kurir</a></li>
                            <li><a href="DataHarga.php">Data Harga Jasa</a></li>
                            <li><a href="DataKendaran.php">Data Kendaraan</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="toggle-submenu"><i class="fa-solid fa-layer-group me-2"></i>Order<i
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
            <!-- Main content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
                <div class="d-flex justify-content-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Order</li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Transaksi</li>
                    </ol>
                </div>

                <table id="example" class="table table-striped" style="overflow-x: auto; overflow-y: auto !important;">
                    <thead>
                        <tr>
                            <th style="width: 30px;">No</th>
                            <th style="width: 30px;">Id</th>
                            <th class="text-center" style="width: 150px;">Nama Barang</th>
                            <th class="text-center" style="width: 150px;">Email</th>
                            <th class="text-center" style="width: 100px;">No Telepon</th>
                            <th class="text-center" style="width: 150px;">Bukti Pembayaran</th>
                            <th class="text-center" style="width: 100px;">Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
include("inc.koneksi.php");

                        $sql = "SELECT * FROM `order`";
                        $query = mysqli_query($koneksi, $sql);
                        $no = 1;

                        while($order = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>".$no++."</td>";
                            echo "<td>".$order['Id']."</td>";
                            echo "<td>".$order['nama_barang']."</td>";
                            echo "<td>".$order['email']."</td>";
                            echo "<td class='text-center'><a href='https://wa.me/".$order['no_telepon']."'><i class='fab fa-whatsapp fs-2'></i></a></td>";
                            echo "<td class='text-center'><a href='Download_Bukti.php?id=".$order['Id']."'>Unduh</a></td>";

                            echo "<td>Rp. ".number_format($order['harga'], 0, ',', '.').",-</td>";

                            $statusPembayaranClass = "";
                            $statusPembayaranText = "";

                            if($order['status_pembayaran'] == 0) {
                                $statusPembayaranClass = "btn-warning";
                                $statusPembayaranText = "Pending";
                            } elseif($order['status_pembayaran'] == 1) {
                                $statusPembayaranClass = "btn-success";
                                $statusPembayaranText = "Payment";
                            } else {
                                // Handle kondisi jika status_pembayaran tidak cocok dengan yang diinginkan
                                $statusPembayaranClass = "btn-secondary";
                                $statusPembayaranText = "Undefined";
                            }

                            echo "<td><button class='btn btn-sm form-control $statusPembayaranClass'>$statusPembayaranText</button></td>";


                            echo "</tr>";
                        }

                        mysqli_close($koneksi);
                        ?>


                    </tbody>
                </table>
            </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="Admin.js"></script>
<script src="EditDataCustomer.js"></script>

</html>