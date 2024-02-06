<?php session_start();

include("inc.koneksi.php");
// Query database untuk mendapatkan semua data harga
$sql = "SELECT Id, harga FROM harga_jasa";
$result = mysqli_query($koneksi, $sql);

// Inisialisasi array harga
$harga = array();

// Memproses hasil query dan menyimpan harga ke dalam array
while ($row = mysqli_fetch_assoc($result)) {
    $harga[$row['Id']] = $row['harga'];
}

// Setiap harga sekarang dapat diakses menggunakan $harga[ID]
$hargaMinivans = $harga[1];
$hargaTruckCargo = $harga[2];
$hargaCarryPickup = $harga[3];
$hargaPlaneExpress = $harga[4];
$hargaMotor = $harga[5];
$hargaShipCargo = $harga[10];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
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
                        <a class="nav-link active" href="Information.php">Information</a>
                        <?php
                        if (isset($_SESSION['email'])) {
                            echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Service</a>';
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
    <section>
        <div class="image-overlay">
            <img src="Image/Gambar4.png" alt="gambar2">
            <div class="overlay-content">
                <h2 class="fs-1 fw-bold">We’re Here To
                    <br><span style="font-style: italic; color: bisque; text-decoration: underline;">Guarantee Your
                        Success</span>
                </h2>
            </div>
        </div>
    </section>


    <h1 class="mt-5 fw-bolder text-center">Layanan Transportasi Kami</h1>

    <div class="container">
        <hr size="5">
    </div>
    <div class="container mt-5">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="Image/O1.png" class="card-img-top" alt="Produk 1">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Minivans</h5>
                                    <p class="card-text">Minivans ideal untuk kurir, dengan ruang kargo luas dan
                                        manuverabilitas baik. Mereka efisien & andal dalam mengantarkan barang.</p>
                                    <p class="card-text fw-bold">Harga: Rp.
                                        <?php echo number_format($hargaMinivans, 0, ',', '.'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="Image/O2.png" class="card-img-top" alt="Produk 2">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Truck Cargo</h5>
                                    <p class="card-text">Truck cargo adalah kendaraan besar yang kuat untuk
                                        mengangkut
                                        beban berat dengan efisiensi dan kemampuan yang luar biasa.</p>
                                    <p class="card-text fw-bold">Harga: Rp.
                                        <?php echo number_format($hargaTruckCargo, 0, ',', '.'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="Image/O3.jpg" class="card-img-top" alt="Produk 3">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Carry Pickup</h5>
                                    <p class="card-text">Pickup adalah kendaraan serbaguna dengan kabin yang nyaman
                                        dan
                                        bak yang ideal untuk angkutan ringan.</p>
                                    <p class="card-text fw-bold">Harga: Rp.
                                        <?php echo number_format($hargaCarryPickup, 0, ',', '.'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="Image/O4.jpg" class="card-img-top" alt="Produk 4">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Ship Cargo</h5>
                                    <p class="card-text">Kapal kargo adalah raksasa laut, mampu mengangkut muatan
                                        besar
                                        di seluruh dunia, Untuk Perdagangan International.</p>
                                    <p class="card-text fw-bold">Harga: Rp.
                                        <?php echo number_format($hargaShipCargo, 0, ',', '.'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="Image/O5.jpg" class="card-img-top" alt="Produk 5">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Plane Express</h5>
                                    <p class="card-text">Pesawat adalah mode transportasi udara yang menghubungkan
                                        tempat-tempat di seluruh dunia, memberikan mobilitas cepat.</p>
                                    <p class="card-text fw-bold">Harga: Rp.
                                        <?php echo number_format($hargaPlaneExpress, 0, ',', '.'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="Image/O6.jpg" class="card-img-top" alt="Produk 6">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Motor</h5>
                                    <p class="card-text">Jasa pengiriman yang mengandalkan sepeda motor sebagai
                                        sarana
                                        pengiriman yang cepat dan efisien ke tujuan yang ditentukan.</p>
                                    <p class="card-text fw-bold">Harga: Rp.
                                        <?php echo number_format($hargaMotor, 0, ',', '.'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <h1 class="mt-5 fw-bolder text-center">Layanan Service Kami</h1>
    <div class="container mt-5">
        <hr size="5">
    </div>

    <section class="container">
        <div class="row">
            <div class="col-4">
                <h1 class="mt-5 fw-bolder" style="color: #A8C027;">Layanan Kurir</h1>
                <span class="mt-1" style="font-size: 14px;">Kami menyediakan layanan kurir andal dan efisien untuk
                    kebutuhan pengiriman Anda.</span>
                <p class="fw-bold mt-4 mb-1">Pengiriman Cepat</p>
                <p class="fw-bold mb-1">Pelacakan Kiriman</p>
                <p class="fw-bold mb-1">Pengiriman Aman</p>
                <p class="fw-bold mb-1">Pengiriman Internasional</p>
            </div>
            <div class="col"><img src="Image/I1.png" class="img-fluid float-end w-60 mt-5"
                    alt="Gambar Layanan Kurir"></div>
        </div>
    </section>
    <section class="container mt-5">
        <div class="row">
            <div class="col"><img src="Image/I2.png" class="img-fluid w-60 mt-5" alt="Gambar Pemasaran Digital">
            </div>
            <div class="col-4 text-end">
                <h1 class="mt-5 fw-bolder" style="color: #A8C027;">Solusi Pengiriman</h1>
                <span class="mt-1" style="font-size: 14px;">Solusi pengiriman yang disesuaikan untuk mengoptimalkan
                    logistik Anda.</span>
                <p class="fw-bold mt-4 mb-1">Pengiriman Kilometer Terakhir</p>
                <p class="fw-bold mb-1">Layanan Pemenuhan</p>
                <p class="fw-bold mb-1">Optimasi Rute</p>
                <p class="fw-bold mb-1">Pengiriman Terjadwal</p>
            </div>
        </div>
    </section>
    <section class="container mt-5">
        <div class="row">
            <div class="col-5">
                <h1 class="mt-5 fw-bolder" style="color: #A8C027;">Kepuasan Pelanggan</h1>
                <span class="mt-1" style="font-size: 14px;">Kami fokus pada kepuasan pelanggan dengan layanan pengiriman
                    kami.</span>
                <p class="fw-bold mt-4 mb-1">Dukungan Pelanggan 24/7</p>
                <p class="fw-bold mb-1">Pelacakan Pengiriman</p>
                <p class="fw-bold mb-1">Pembaruan Real-Time</p>
            </div>
            <div class="col"><img src="Image/I3.png" class="img-fluid float-end w-60 mt-5"
                    alt="Gambar Kepuasan Pelanggan"></div>
        </div>
    </section>
    <section class="container mt-5">
        <div class="row">
            <div class="col"><img src="Image/I4.png" class="img-fluid w-60 mt-5" alt="Gambar Rekrutmen SDM"></div>
            <div class="col-4 text-end">
                <h1 class="mt-5 fw-bolder" style="color: #A8C027;">Cepat dan Handal</h1>
                <span class="mt-1" style="font-size: 14px;">Kami menawarkan layanan pengiriman yang cepat dan andal
                    untuk ketenangan pikiran Anda.</span>
                <p class="fw-bold mt-4 mb-1">Pengiriman Cepat</p>
                <p class="fw-bold mb-1">Tindakan Keamanan</p>
                <p class="fw-bold mb-1">Kurir Profesional</p>
                <p class="fw-bold mb-1">Pengemasan Aman</p>
                <p class="fw-bold mb-1">Pengiriman Tepat Waktu</p>
            </div>
        </div>
    </section>

    <div class="container mt-5">
        <hr size="5">
    </div>

    <section class="container">
        <div class="row">
            <div class="col-5"><img src="Image/E1.png" class="img-fluid float-end mt-4" alt="gambar1"></div>
            <div class="col-7">
                <h1 class="mt-5 mb-5 fw-bolder text-center">"Collaborate for Success, Join the Excellence Expedition!"
                </h1>
                <span class="mt-5"><em>"Bergabunglah bersama kami, dan jadilah bagian dari perjalanan menuju keunggulan!
                        Kami mengundang Anda untuk merasakan kekuatan kolaborasi, di mana tekad kami untuk menyambungkan
                        Anda dengan kesuksesan menjadi semakin kuat. Dengan bergabung, Anda tidak hanya menjadi mitra
                        dalam menghadapi setiap rintangan dan menaklukkan setiap kilometer, tetapi juga mendapatkan
                        kesempatan untuk tumbuh dan berkembang bersama kami. Mari bersama-sama membentuk masa depan yang
                        sukses, langkah demi langkah, hari demi hari!"</em></span>
                <p class="mt-5"><a href="Order.php"><button type="submit" name="submit"
                            class="form-control btn btn-outline-secondary">Pesan
                            Sekarang</button></a></p>
            </div>
        </div>
    </section>

    <?php
    // Check if the 'email' session variable is set and not empty
    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        echo '<div id="notificationPopup" class="notification-popup">';
        echo '    <div id="notificationPopupContent"></div>';
        echo '    <button id="closeNotificationPopup" class="btn btn-light mt-2">Tutup</button>';
        echo '</div>';
    }
    ?>

    <footer class="bg-white navbarcolor mt-5">
        <div class="container my-0">
            <div class="row">
                <div class="col-4">
                    <p class="fw-bold mt-5 fs-2 w-75">Our Contact Details</p>
                    <span>Let’s connect</span>
                </div>
                <div class="col-4">
                    <p class="fw-bold mt-5">Telephone</p>
                    <div>(0778) 469860</div>
                    <p class="fw-bold mt-5">WhatsApp</p>
                    <div>+62-778-469858</div>
                </div>
                <div class="col-4">
                    <p class="fw-bold mt-5">Office</p>
                    <div>Batam Centre, Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29461
                    </div>
                    <p class="fw-bold mt-4">Email</p>
                    <div>info@polibatam.ac.id</div>
                </div>
                <p class="mt-5">&copy;PBL Politeknik Negeri Batam 2023</p>
            </div>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
    integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="custom.js"></script>
<script src="Notification.js"></script>
</html>