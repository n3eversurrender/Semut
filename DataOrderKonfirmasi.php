<?php
session_start();

if(!isset($_SESSION['email']) or !isset($_SESSION['is_admin'])) {
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
    <title>Konfirmasi Order</title>
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
                        <li class="breadcrumb-item active" aria-current="page">Konfirmasi Order</li>
                    </ol>
                </div>

                <table id="example" class="table table-striped"
                    style="width:100%; overflow-x: auto; overflow-y: auto !important;">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Id</th>
                            <th>Nama Barang</th>
                            <th>Email</th>
                            <th class="text-center">No Telepon</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
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
                            echo "<td class='text-center'><a href='https://wa.me/".$order['no_telepon']."'><i class='fab fa-whatsapp fs-3'></i></a></td>";

                            $statusClass = "";
                            $statusText = "";

                            if($order['status'] == 1) {
                                $statusClass = "btn-info";
                                $statusText = "Checking";
                            } elseif($order['status'] == 2) {
                                $statusClass = "btn-warning";
                                $statusText = "Delivery";
                            } elseif($order['status'] == 3) {
                                $statusClass = "btn-success";
                                $statusText = "Complete";
                            } elseif($order['status'] == 4) {
                                $statusClass = "btn-danger";
                                $statusText = "Cancel";
                            } else {
                                $statusClass = "btn-secondary";
                                $statusText = "Undefined";
                            }

                            echo "<td><button class='btn btn-sm form-control $statusClass'>$statusText</button></td>";

                            echo "<td class='d-flex'>
                                    <button class='btn btn-sm btn-primary form-control me-2' data-bs-toggle='modal' data-bs-target='#editDataModal".$order['Id']."'><i class='fa-solid fa-pen-to-square'></i></button>
                                  </td>";

                            echo "</tr>";

                            // Modal Edit untuk setiap order
                            echo "<div class='modal fade' id='editDataModal".$order['Id']."' tabindex='-1' aria-labelledby='editDataModalLabel".$order['Id']."' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='editDataModalLabel".$order['Id']."'>Edit Order</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                            <form action='Order_Edit.php' method='post' id='editOrderForm".$order['Id']."'>                                                    <div class='mb-3'>
                                                        <label for='editNamaBarang' class='form-label'>Nama Barang</label>
                                                        <input type='text' class='form-control' id='editNamaBarang".$order['Id']."' name='editNamaBarang' value='".$order['nama_barang']."' required readonly>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='editEmail' class='form-label'>Email</label>
                                                        <input type='email' class='form-control' id='editEmail".$order['Id']."' name='editEmail' value='".$order['email']."' required readonly>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='editNoTelepon' class='form-label'>No Telepon</label>
                                                        <input type='tel' class='form-control' id='editNoTelepon".$order['Id']."' name='editNoTelepon' value='".$order['no_telepon']."' required readonly>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='editStatus' class='form-label'>Status</label>
                                                        <select class='form-select' id='editStatus".$order['Id']."' name='editStatus' required>
                                                            <option value='1' ".($order['status'] == 1 ? 'selected' : '').">Checking</option>
                                                            <option value='2' ".($order['status'] == 2 ? 'selected' : '').">Delivery</option>
                                                            <option value='3' ".($order['status'] == 3 ? 'selected' : '').">Complete</option>
                                                            <option value='4' ".($order['status'] == 4 ? 'selected' : '').">Cancel</option>
                                                        </select>
                                                    </div>
                                                    <input type='hidden' name='orderId' value='".$order['Id']."'>
                                                    <button type='submit' class='btn btn-primary'>Simpan Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }

                        mysqli_close($koneksi);
                        ?>

                    </tbody>
                </table>
            </main>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="Admin.js"></script>

</html>