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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kurir</title>
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
                <div class="d-flex justify-content-between">
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addKurirModal"><i
                            class="fa-solid fa-plus me-2"></i>Tambah
                        Data</button>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">Data Kurir</li>
                        </ol>
                    </nav>
                </div>
                <table id="example" class="table table-striped"
                    style="width:100%; overflow-x: auto; overflow-y: auto !important;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Jenis Kendaraan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("inc.koneksi.php");

                        $sql = "select * from `kurir`";
                        $query = mysqli_query($koneksi, $sql);
                        $no = 1;

                        while ($kurir = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            // Kolom data kurir
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $kurir['nama'] . "</td>";
                            echo "<td>" . $kurir['alamat'] . "</td>";
                            echo "<td class='text-center'><a href='https://wa.me/" . $kurir['no_telepon'] . "'><i class='fab fa-whatsapp fs-3'></i></a></td>";

                            $modelClass = "";
                            $modelText = "";

                            if ($kurir['model'] == 1) {
                                $modelClass = "btn-warning";
                                $modelText = "Truck Cargo";
                            } elseif ($kurir['model'] == 2) {
                                $modelClass = "btn-warning";
                                $modelText = "Minivans";
                            } elseif ($kurir['model'] == 3) {
                                $modelClass = "btn-warning";
                                $modelText = "Motor";
                            } elseif ($kurir['model'] == 4) {
                                $modelClass = "btn-warning";
                                $modelText = "Carry PickUp";
                            } elseif ($kurir['model'] == 5) {
                                $modelClass = "btn-warning";
                                $modelText = "Ship Cargo";
                            } elseif ($kurir['model'] == 6) {
                                $modelClass = "btn-warning";
                                $modelText = "Plane Express";
                            } else {
                                $modelClass = "btn-secondary";
                                $modelText = "Undefined";
                            }

                            echo "<td><button class='btn btn-sm form-control $modelClass'>$modelText</button></td>";


                            $statusClass = ($kurir['status'] == 1) ? "btn-success" : "btn-secondary";
                            $statusText = ($kurir['status'] == 1) ? "Mengantar" : "Stay";
                            echo "<td><button class='btn btn-sm form-control $statusClass'>$statusText</button></td>";

                            // Tombol "Edit" dengan memicu modal
                            echo "<td class='d-flex justify-content-center'>
                                    <button class='btn btn-sm btn-secondary me-2 view-button' data-bs-toggle='modal' data-bs-target='#viewKurirModal" . $kurir['Id'] . "'><i class='fa-solid fa-eye'></i></button>
                                    <button class='btn btn-sm btn-primary me-2 edit-button' data-bs-toggle='modal' data-bs-target='#editKurirModal" . $kurir['Id'] . "'><i class='fa-solid fa-pen-to-square'></i></button>
                                    <a href='Kurir_Delete.php?id=" . $kurir['Id'] . "' class='btn btn-sm btn-danger'><i class='fa-solid fa-trash'></i></a>
                                </td>";

                            // Modal View untuk setiap kurir
                            echo "<div class='modal fade' id='viewKurirModal" . $kurir['Id'] . "' tabindex='-1' aria-labelledby='viewKurirModalLabel" . $kurir['Id'] . "' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='viewKurirModalLabel" . $kurir['Id'] . "'>View Kurir</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>

                                                <div class='mb-3 row'>
                                                    <label for='editId' class='col-sm-4 fw-bold'>Id Kurir</label>
                                                        <div class='col-sm-6'>
                                                            <div id='editId" . $kurir['Id'] . "'>: " . $kurir['Id'] . "</div>
                                                    </div>
                                                </div>
                                                
                                                <div class='mb-3 row'>
                                                    <label for='editNama' class='col-sm-4 fw-bold'>Nama</label>
                                                        <div class='col-sm-6'>
                                                            <div id='editNama" . $kurir['nama'] . "'>: " . $kurir['nama'] . "</div>
                                                    </div>
                                                </div>

                                                <div class='mb-3 row'>
                                                    <label for='editAlamat' class='col-sm-4 fw-bold'>Alamat</label>
                                                        <div class='col-sm-6'>
                                                            <div id='editAlamat" . $kurir['alamat'] . "'>: " . $kurir['alamat'] . "</div>
                                                    </div>
                                                </div>

                                                <div class='mb-3 row'>
                                                    <label for='editNo_Telepon' class='col-sm-4 fw-bold'>Nomor Telepon</label>
                                                        <div class='col-sm-6'>
                                                            <div id='editNo_Telepon" . $kurir['no_telepon'] . "'>: " . $kurir['no_telepon'] . "</div>
                                                    </div>
                                                </div>

                                                <div class='mb-3 row'>
                                                    <label for='editJenis_Kendaraan' class='col-sm-4 fw-bold'>Jenis Kendaraan</label>
                                                        <div class='col-sm-6'>
                                                            <div id='editJenis_Kendaraan" . $kurir['jenis_kendaraan'] . "'>: " . $kurir['jenis_kendaraan'] . "</div>
                                                    </div>
                                                </div>

                                                <div class='mb-3 row'>
                                                <label for='editWarna' class='col-sm-4 fw-bold'>Warna</label>
                                                <div class='col-sm-6'>
                                                    <div id='editWarna" . $kurir['warna'] . "'>: " . $kurir['warna'] . "</div>
                                                </div>
                                            </div>
                                        
                                            <div class='mb-3 row'>
                                                <label for='editNomor_Plat' class='col-sm-4 fw-bold'>Nomor Plat</label>
                                                <div class='col-sm-6'>
                                                    <div id='editNomor_Plat" . $kurir['nomor_plat'] . "'>: " . $kurir['nomor_plat'] . "</div>
                                                </div>
                                            </div>
                                        
                                            <div class='mb-3 row'>
                                                <label for='editStatus' class='col-sm-4 fw-bold'>Status</label>
                                                <div class='col-sm-6'>
                                                    <div id='editStatus" . $kurir['status'] . "'>: " . ($kurir['status'] == 1 ? 'Mengantar' : 'Stay') . "</div>
                                                </div>
                                            </div>
                                        
                                            <div class='mb-3 row'>
                                                <label for='editModel' class='col-sm-4 fw-bold'>Model</label>
                                                <div class='col-sm-6'>
                                                    <div id='editModel" . $modelText . "'>: " . $modelText . "</div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";


                            // Modal Tambah Data
                            echo "<div class='modal fade' id='addKurirModal' tabindex='-1' aria-labelledby='addKurirModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='addKurirModalLabel'>Tambah Kurir</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <form action='Kurir_Add.php' method='post'>

                                                <!-- Formulir tambah data -->
                                                <div class='mb-3'>
                                                    <label for='addKurirNama' class='form-label'>Nama</label>
                                                    <input type='text' class='form-control' id='addKurirNama' name='addKurirNama' required>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='addKurirAlamat' class='form-label'>Alamat</label>
                                                    <input type='text' class='form-control' id='addKurirAlamat' name='addKurirAlamat' required>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='addKurirNo_Telepon' class='form-label'>No Telepon</label>
                                                    <input type='text' class='form-control' id='addKurirNo_Telepon' name='addKurirNo_Telepon' required>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='addKurirModel' class='form-label'>Model</label>
                                                    <select class='form-select' id='addKurirModel' name='addKurirModel' required>
                                                        <option value='1'>Truck Cargo</option>
                                                        <option value='2'>Minivans</option>
                                                        <option value='3'>Motor</option>
                                                        <option value='4'>Carry PickUp</option>
                                                        <option value='5'>Ship Cargo</option>
                                                        <option value='6'>Plane Express</option>
                                                    </select>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='addKurirJenis_Kendaraan' class='form-label'>Jenis Kendaraan</label>
                                                    <input type='text' class='form-control' id='addKurirJenis_Kendaraan' name='addKurirJenis_Kendaraan' required>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='addKurirWarna' class='form-label'>Warna</label>
                                                    <input type='text' class='form-control' id='addKurirWarna' name='addKurirWarna' required>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='addKurirNomor_Plat' class='form-label'>Nomor Plat</label>
                                                    <input type='text' class='form-control' id='addKurirNomor_Plat' name='addKurirNomor_Plat' required>
                                                </div>
                                                <button type='submit' class='btn btn-primary'>Simpan Data</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                            // Modal Update untuk setiap kurir
                            echo "<div class='modal fade' id='editKurirModal" . $kurir['Id'] . "' tabindex='-1' aria-labelledby='editKurirModalLabel" . $kurir['Id'] . "' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='editKurirModalLabel" . $kurir['Id'] . "'>Edit Kurir</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <form action='Kurir_Edit.php' method='post'>
                                            <input type='hidden' name='kurirId' value='" . $kurir['Id'] . "'>
                                            <div class='mb-3'>
                                                <label for='editKurirNama' class='form-label'>Nama</label>
                                                <input type='text' class='form-control' id='editKurirNama' name='editKurirNama' value='" . $kurir['nama'] . "' required>
                                            </div>
                                            <div class='mb-3'>
                                                <label for='editKurirAlamat' class='form-label'>Alamat</label>
                                                <input type='text' class='form-control' id='editKurirAlamat' name='editKurirAlamat' value='" . $kurir['alamat'] . "' required>
                                            </div>
                                            <div class='mb-3'>
                                                <label for='editKurirNo_Telepon' class='form-label'>No Telepon</label>
                                                <input type='text' class='form-control' id='editKurirNo_Telepon' name='editKurirNo_Telepon' value='" . $kurir['no_telepon'] . "' required readonly>
                                            </div>
                                            <div class='mb-3'>
                                            <label for='editKurirJenis_Kendaraan' class='form-label'>Jenis Kenadaraan</label>
                                            <input type='text' class='form-control' id='editKurirJenis_Kendaraan' name='editKurirJenis_Kendaraan' value='" . $kurir['jenis_kendaraan'] . "' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='editKurirWarna' class='form-label'>Warna</label>
                                            <input type='text' class='form-control' id='editKurirWarna' name='editKurirWarna' value='" . $kurir['warna'] . "' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='editKurirNomor_Plat' class='form-label'>Nomor Plat</label>
                                            <input type='text' class='form-control' id='editKurirNomor_Plat' name='editKurirNomor_Plat' value='" . $kurir['nomor_plat'] . "' required>
                                        </div>
                                            <div class='mb-3'>
                                                <label for='editKurirModel' class='form-label'>Model</label>
                                                <select class='form-select' id='editKurirModel" . $kurir['Id'] . "' name='editKurirModel' required>
                                                    <option value='1' " . ($kurir['model'] == 1 ? 'selected' : '') . ">Truck Cargo</option>
                                                    <option value='2' " . ($kurir['model'] == 2 ? 'selected' : '') . ">Minivans</option>
                                                    <option value='3' " . ($kurir['model'] == 3 ? 'selected' : '') . ">Motor</option>
                                                    <option value='4' " . ($kurir['model'] == 4 ? 'selected' : '') . ">Carry PickUp</option>
                                                    <option value='5' " . ($kurir['model'] == 5 ? 'selected' : '') . ">Ship Cargo</option>
                                                    <option value='6' " . ($kurir['model'] == 6 ? 'selected' : '') . ">Plane Express</option>
                                                </select>
                                            </div>
                                            <div class='mb-3'>
                                                <label for='editKurirStatus' class='form-label'>Status</label>
                                                <select class='form-select' id='editKurirStatus' name='editKurirStatus' required>
                                                    <option value='1' " . ($kurir['status'] == 1 ? 'selected' : '') . ">Mengantar</option>
                                                    <option value='0' " . ($kurir['status'] == 0 ? 'selected' : '') . ">Stay</option>
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