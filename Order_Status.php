<?php session_start();
include("inc.koneksi.php");

if (!isset($_SESSION['email']) or !isset($_SESSION['is_customer'])) {
    // Jika tidak ada sesi email, arahkan ke halaman login
    header("Location: SignInCustomer.php");
    exit();
}

include("inc.koneksi.php");

// Dapatkan email pengguna dari sesi
$email = $_SESSION['email'];

$sql = "SELECT * FROM `order` WHERE email = '$email' AND status <> 3";
$query = mysqli_query($koneksi, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Notification.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbarcolor fixed-top">
        <div class="container-fluid ms-5">
            <a class="navbar-brand fw-bold fs-4" href="Home.php">SEMUT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AboutUs.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Information.php">Information</a>
                    </li>

                    <?php
                    if (isset($_SESSION['email'])) {
                        echo '<li class="nav-item dropdown">';
                        echo '<a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Service</a>';
                        echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        echo '<li><a class="dropdown-item" href="Profile.php">My Profile</a></li>';
                        echo '<div class="dropdown-divider"></div>';
                        echo '<li><a class="dropdown-item" href="PriceEstimation.php">Price Estimation</a></li>';
                        echo '<li><a class="dropdown-item" href="Order.php">Order</a></li>';
                        echo '<li><a class="dropdown-item" href="Order_Status.php">Order Status</a></li>';
                        echo '<li><a class="dropdown-item" href="Order_History.php">Order History</a></li>';
                        echo '</ul>';
                        echo '</li>';
                    }
                    ?>

                </ul>
                </li>
                </ul>

                <!-- notifikasi -->
                <?php
                if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                    echo '<a class="nav-link" href="#" id="notificationIcon">';
                    echo '<i class="fas fa-bell fs-5"></i>';
                    echo '<span id="notificationCount" class="badge bg-danger">0</span>';
                    echo '</a>';
                }
                ?>


                <?php
                if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                    // echo "<p class='text-sm'>" . $_SESSION['email'] . "</p>";
                    echo "<a href='logoutCustomer.php'> <button class='btn btn-outline-danger me-2' type='submit'>Logout <i class='fa-solid fa-arrow-right'></i></button>
                 </a>";
                } else {
                    echo "<a href='SignInCustomer.php'>
                <button class='btn btn-outline-success me-2' type='submit'>Login <i class='fa-solid fa-arrow-right'></i></button>
               </a>";
                }
                ?>

            </div>
        </div>
    </nav>

    <div class="row mt-5"></div>
    <div class="row mt-3"></div>
    <div class="container">
        <div class="row">
            <div class="img col-md-6 mt-4 d-flex align-items-center">
                <img src="Image/O7.png" alt="Logo" class="w-100">
            </div>
            <div class="col-md-6">
                <h1 class="mt-5 fw-bold">Daftar Pesanan</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Barang</th>
                            <th>Order</th>
                            <th>Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($order = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>" . $order['Id'] . "</td>";
                            echo "<td>" . $order['nama_barang'] . "</td>";

                            $statusClass = "";
                            $statusText = "";

                            if ($order['status'] == 1) {
                                $statusClass = "btn-info";
                                $statusText = "Checking";
                            } elseif ($order['status'] == 2) {
                                $statusClass = "btn-warning";
                                $statusText = "Delivery";
                            } elseif ($order['status'] == 3) {
                                $statusClass = "btn-success";
                                $statusText = "Complete";
                            } elseif ($order['status'] == 4) {
                                $statusClass = "btn-danger";
                                $statusText = "Cancel";
                            } else {
                                $statusClass = "btn-secondary";
                                $statusText = "Undefined";
                            }

                            echo "<td><button class='btn btn-sm form-control $statusClass'>$statusText</button></td>";

                            $statusPembayaranClass = "";
                            $statusPembayaranText = "";

                            if ($order['status_pembayaran'] == 0) {
                                $statusPembayaranClass = "btn-secondary";
                                $statusPembayaranText = "Pending";
                            } elseif ($order['status_pembayaran'] == 1) {
                                $statusPembayaranClass = "btn-success";
                                $statusPembayaranText = "Payment";
                            } else {
                                // Handle kondisi jika status_pembayaran tidak cocok dengan yang diinginkan
                                $statusPembayaranClass = "btn-secondary";
                                $statusPembayaranText = "Undefined";
                            }


                            echo "<td><button class='btn btn-sm form-control $statusPembayaranClass'>$statusPembayaranText</button></td>";

                            if ($order['status_pembayaran'] == 0) {
                                echo "<td class='d-flex'>
                                    <button class='btn btn-sm btn-primary me-2' data-bs-toggle='modal' data-bs-target='#editDataModal" . $order['Id'] . "'><i class='fa-solid fa-cloud-arrow-up'></i></button>
                                    <a href='Order_Status_Delete.php?id=" . $order['Id'] . "' class='btn btn-sm btn-danger' onclick='return confirmDelete()'><i class='fa-solid fa-trash'></i></a>
                                    </td>";

                                echo "</tr>";


                                // Modal Edit untuk setiap order
                                echo "<div class='modal fade' id='editDataModal" . $order['Id'] . "' tabindex='-1' aria-labelledby='editDataModalLabel" . $order['Id'] . "' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='editDataModalLabel" . $order['Id'] . "'>Detail Orderan</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                        <div class='modal-body'>
                                        <form action='Order_Status_Edit.php' method='post' id='editOrderForm" . $order['Id'] . "' enctype='multipart/form-data' onsubmit='return confirmUpload(" . $order['Id'] . ")'>

                                            <div class='mb-3 row'>
                                                <!-- Id Orderan -->
                                                <label for='editId' class='col-sm-4 fw-bold'>Id Orderan</label>
                                                <div class='col-sm-6'>
                                                    <div id='editId" . $order['Id'] . "'>: " . $order['Id'] . "</div>
                                                </div>
                                            </div>

                                            <div class='mb-3 row'>
                                                <!-- Nama Barang -->
                                                <label for='editNamaBarang' class='col-sm-4 fw-bold'>Nama Barang</label>
                                                <div class='col-sm-6'>
                                                    <div id='editNamaBarang" . $order['Id'] . "'>: " . $order['nama_barang'] . "</div>
                                                </div>
                                            </div>
                                
                                            <div class='mb-3 row'>
                                                <!-- Email -->
                                                <label for='editEmail' class='col-sm-4 fw-bold'>Email</label>
                                                <div class='col-sm-6'>
                                                    <div id='editEmail" . $order['Id'] . "'>: " . $order['email'] . "</div>
                                                </div>
                                            </div>
                                            
                                            <div class='mb-3 row'>
                                                <!-- No Telepon -->
                                                <label for='editNoTelepon' class='col-sm-4 fw-bold'>No Telepon</label>
                                                <div class='col-sm-6'>
                                                    <div id='editNoTelepon" . $order['Id'] . "'>: " . $order['no_telepon'] . "</div>
                                                </div>
                                            </div>
                                            
                                            <div class='mb-3 row'>
                                                <!-- Harga -->
                                                <label for='editHarga' class='col-sm-4 fw-bold'>Harga</label>
                                                <div class='col-sm-6'>
                                                    <div id='editHarga" . $order['Id'] . "'>: Rp." . number_format($order['harga'], 0, '.', '.') . "</div>
                                                </div>
                                            </div>
                                

                                            <div class='mt-5 border-top'>
                                                <label for='editBuktiPembayaran' class='form-label mt-2'>Bukti Pembayaran</label>
                                                <input type='file' class='form-control' id='editBuktiPembayaran" . $order['Id'] . "' name='editBuktiPembayaran' accept='image/*' required>
                                            </div>

                    
                                            <input type='hidden' name='orderId' value='" . $order['Id'] . "'>
                                            <button type='submit' class='btn btn-primary mt-4'>Upload Bukti</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
                            }
                        }

                        mysqli_close($koneksi);
                        ?>
                    </tbody>
                </table>
                <div class="container mt-3">
                    <a href="Order.php" class="form-control mt-3 btn btn-outline-secondary">Pesan Lagi</a>
                </div>
            </div>
        </div>

        <div id="notificationPopup" class="notification-popup">
            <div id="notificationPopupContent"></div>
            <button id="closeNotificationPopup" class="btn btn-light mt-2">Tutup</button>
        </div>


        <footer class="bg-white mt-5">
            <div class="container my-0">
                <p>&copy;PBL Politeknik Negeri Batam 2023</p>
            </div>
        </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
    integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="custom.js"></script>
<script src="Notification.js"></script>
<script>
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin membatalkan pesanan?");
    }

    function confirmUpload(orderId) {
        var buktiPembayaran = document.getElementById('editBuktiPembayaran' + orderId).value;
        if (buktiPembayaran.trim() !== "") {
            alert("Bukti pembayaran untuk Order Id " + orderId + " berhasil diupload.");
            return true;  // Allow form submission
        } else {
            alert("Silakan pilih file bukti pembayaran terlebih dahulu.");
            return false;  // Prevent form submission
        }
    }
</script>

</html>