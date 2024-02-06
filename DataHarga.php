<?php
session_start(); // Mulai sesi

// Periksa apakah pengguna sudah masuk (sesi email sudah ada)
if (!isset($_SESSION['email']) or !isset($_SESSION['is_admin'])) {
    // Jika tidak ada sesi email, arahkan ke halaman login
    header("Location: SignInAdmin.php");
    exit();
}
include("inc.koneksi.php");

// Dapatkan email pengguna dari sesi
$email = $_SESSION['email'];
$is_admin = $_SESSION['is_admin'];

// Setel informasi role ke dalam sesi (dalam contoh ini, saya asumsikan role 1 sebagai Admin, dan role 0 sebagai User)
$role = ($is_admin == 1) ? "Admin" : "User";
$_SESSION['role'] = $role;


$sqlStatus = "SELECT Status, Position FROM admin WHERE Email = '$email'";
$queryStatus = mysqli_query($koneksi, $sqlStatus);
$statusData = mysqli_fetch_assoc($queryStatus);

if ($statusData['Status'] == 0) {
    // Jika status "Unactive," arahkan ke halaman logout atau berikan pesan kesalahan
    header("Location: logout.php"); // Gantilah ini dengan halaman yang sesuai
    exit();
}

// Dapatkan informasi Position pengguna dari hasil query
$position = $statusData['Position'];
$_SESSION['position'] = $position;

// Tombol "Edit" dan "Delete" hanya untuk Super Admin
$showButtons = ($position == 1 && $is_admin == 1);
$showAddButton = ($position == 1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Admin</title>
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
                <div class="d-flex">
                    <?php if ($showAddButton): ?>
                        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addHargaModal">
                            <i class="fa-solid fa-plus me-2"></i>Tambah Data
                        </button>
                    <?php endif; ?>

                    <div class="ms-auto">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Master Data</li>
                                <li class="breadcrumb-item active" aria-current="page">Data Harga</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <table id="example" class="table table-striped"
                    style="width:100%; overflow-x: auto; overflow-y: auto !important;">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10px;">No</th>
                            <th>Nama Jasa</th>
                            <th>Harga Jasa</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
include("inc.koneksi.php");

                        $sql = "select * from `harga_jasa`";
                        $query = mysqli_query($koneksi, $sql);
                        $no = 1;

                        while ($harga_jasa = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            // Kolom data admin
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $harga_jasa['nama'] . "</td>";
                            echo "<td>Rp. ".number_format($harga_jasa['harga'], 0, ',', '.').",-</td>";

                            // Tombol "Edit" dengan memicu modal
                            echo "<td class='d-flex justify-content-center'>";
                            if ($showButtons) {
                                echo "<button class='btn btn-sm btn-primary me-2 edit-button' data-bs-toggle='modal' data-bs-target='#editHargaModal" . $harga_jasa['Id'] . "'><i class='fa-solid fa-pen-to-square'></i></button>";
                                echo "<a href='Harga_Delete.php?id=" . $harga_jasa['Id'] . "' class='btn btn-sm btn-danger'><i class='fa-solid fa-trash'></i></a>";
                            } else {
                                echo "<span class='text-muted'><i class='fa-solid fa-ban fs-2'></i></span>";
                            }
                            echo "</td>";

                            // Modal Tambah Data
                            echo "<div class='modal fade' id='addHargaModal' tabindex='-1' aria-labelledby='addHargaModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='addHargaModalLabel'>Tambah Jasa</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <form action='Harga_Add.php' method='post'>
                                            <!-- Formulir tambah data -->
                                            <div class='mb-3'>
                                                <label for='addHargaNama' class='form-label'>Nama Jasa</label>
                                                <input type='text' class='form-control' id='addHargaNama' name='addHargaNama' required>
                                            </div>
                                            <div class='mb-3'>
                                                <label for='addHarga' class='form-label'>Harga Jasa</label>
                                                <input type='text' class='form-control' id='addHarga' name='addHarga' required>
                                            </div>
                                            <button type='submit' class='btn btn-primary'>Simpan Data</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>";


                            // Modal Update untuk setiap admin
                            echo "<div class='modal fade' id='editHargaModal" . $harga_jasa['Id'] . "' tabindex='-1' aria-labelledby='editHargaModalLabel" . $harga_jasa['Id'] . "' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='editHargaModalLabel" . $harga_jasa['Id'] . "'>Edit Harga Jasa</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='Harga_Edit.php' method='post'>
                                                    <input type='hidden' name='hargaId' value='" . $harga_jasa['Id'] . "'>
                                                    <div class='mb-3'>
                                                        <label for='editHargaNama' class='form-label'>Nama Jasa</label>
                                                        <input type='text' class='form-control' id='editHargaNama' name='editHargaNama' value='" . $harga_jasa['nama'] . "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='editHarga' class='form-label'>Harga Jasa</label>
                                                        <input type='text' class='form-control' id='editHarga' name='editHarga' value='" . $harga_jasa['harga'] . "' required>
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