<?php
session_start();
if (!isset($_SESSION['email']) or !isset($_SESSION['is_admin'])) {
    header("Location: SignInAdmin.php");
    exit();
}

include("inc.koneksi.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Customer</title>
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
                    <li><a href="#" class="toggle-submenu"><i class="fa-solid fa-layer-group me-2"></i>Admin <i class="fa-solid fa-angle-right float-end arrow"></i></a>
                        <ul class="submenu">
                            <li><a href="DataAdmin.php">Data Admin</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="toggle-submenu"><i class="fa-solid fa-layer-group me-2"></i>Master Data<i class="fa-solid fa-angle-right float-end arrow"></i></a>
                        <ul class="submenu">
                            <li><a href="DataCustomer.php">Data Customer</a></li>
                            <li><a href="DataKurir.php">Data Kurir</a></li>
                            <li><a href="DataHarga.php">Data Harga Jasa</a></li>
                            <li><a href="DataKendaran.php">Data Kendaraan</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="toggle-submenu"><i class="fa-solid fa-layer-group me-2"></i>Order<i class="fa-solid fa-angle-right float-end arrow"></i></a>
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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">Data Customer</li>
                        </ol>
                    </nav>
                </div>
                <table id="example" class="table table-striped" style="width:100%; overflow-x: auto; overflow-y: auto !important;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th  class="text-center">No Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `customer`";
                        $query = mysqli_query($koneksi, $sql);
                        $no = 1;

                        while ($customer = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $customer['Nama'] . "</td>";
                            echo "<td>" . $customer['Alamat'] . "</td>";
                            echo "<td>" . $customer['Email'] . "</td>";
                            echo "<td class='text-center'><a href='https://wa.me/".$customer['No_Telepon']."'><i class='fab fa-whatsapp fs-3'></i></a></td>";
                            echo "<td>" . $customer['Jenis_Kelamin'] . "</td>";

                            // Tambahkan tombol "Edit" dengan memicu modal
                            echo "<td class='d-flex justify-content-center'>
                            <button class='btn btn-sm btn-primary me-2' data-bs-toggle='modal' data-bs-target='#editModal" . $customer['Id'] . "'><i class='fa-solid fa-pen-to-square'></i></button>
                            <a href='Customer_Delete.php?id=" . $customer['Id'] . "' class='btn btn-sm btn-danger'><i class='fa-solid fa-trash'></i></a>
                            </td>";

                            // Modal Update untuk setiap pelanggan
                            echo "<div class='modal fade' id='editModal" . $customer['Id'] . "' tabindex='-1' aria-labelledby='editModalLabel" . $customer['Id'] . "' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='editModalLabel" . $customer['Id'] . "'>Edit Customer</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='Customer_Edit.php' method='post'>
                                                    <input type='hidden' name='customerId' value='" . $customer['Id'] . "'>
                                                    <div class='mb-3'>
                                                        <label for='editNama' class='form-label'>Nama</label>
                                                        <input type='text' class='form-control' id='editNama' name='editNama' value='" . $customer['Nama'] . "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='editAlamat' class='form-label'>Alamat</label>
                                                        <input type='text' class='form-control' id='editAlamat' name='editAlamat' value='" . $customer['Alamat'] . "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='editEmail' class='form-label'>Email</label>
                                                        <input type='email' class='form-control' id='editEmail' name='editEmail' value='" . $customer['Email'] . "' required readonly>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='editNoTelepon' class='form-label'>No Telepon</label>
                                                        <input type='tel' class='form-control' id='editNoTelepon' name='editNoTelepon' value='" . $customer['No_Telepon'] . "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='editJenisKelamin' class='form-label'>Jenis Kelamin</label>
                                                        <select class='form-select' id='editJenisKelamin' name='editJenisKelamin' required>
                                                            <option value='Laki-laki' " . ($customer['Jenis_Kelamin'] == 'Laki-laki' ? 'selected' : '') . ">Laki-laki</option>
                                                            <option value='Perempuan' " . ($customer['Jenis_Kelamin'] == 'Perempuan' ? 'selected' : '') . ">Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <button type='submit' class='btn btn-primary'>Simpan Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>";

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

</html>