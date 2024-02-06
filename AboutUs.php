<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Notification.css">
    <style>
        .owl-carousel .item img {
            width: 250px;
            height: auto;
            border-radius: 5%;
        }

        .owl-carousel .item {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .item-content {
            text-align: center;
        }
    </style>
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
                        <a class="nav-link active" href="AboutUs.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Information.php">Information</a>
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
            <img src="Image/gambar2.png" alt="gambar2" style="max-width: 100%; height: auto; width: 100%;">
            <div class="overlay-content"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                <h2 class="fs-1 fw-bold">We’re Here To
                    <br><span style="font-style: italic; color: bisque; text-decoration: underline;">Guarantee Your
                        Success</span>
                </h2>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-5">
                <h1 class="mt-5 mb-5 fw-bolder">Empower Your Business, Delivering Excellence Every Mile!</h1>
                <span class="mt-5"><em>"Kami, dengan tekad keunggulan, siap untuk menghubungkan Anda dengan kesuksesan.
                        Dengan pengiriman yang andal dan penuh dedikasi, kami menjembatani keberhasilan bisnis Anda,
                        melewati setiap rintangan, kilometer demi kilometer, setiap hari."</em></span>
            </div>
            <div class="col"><img src="Image/gambar3.png" class="img-fluid float-end w-100 mt-4" alt="gambar1"></div>
        </div>
    </section>
    <section class="container mt-4">
        <H2 class="fw-bold fs-1"> Our <span style="color: #962F26;">Mission</span> </H2>
        <hr size="5">
        <div class="row">
            <div class="col-6 fw-bold fs-5">Kecepatan</div>
            <div class="col-6 mb-2">Mengantarkan barang dengan cepat dan andal untuk memenuhi tenggat waktu pengiriman
                pelanggan.</div>
            <div class="col-6 fw-bold fs-5">Efisiensi </div>
            <div class="col-6 mb-2">Menawarkan solusi pengiriman yang efisien dengan rute terbaik dan penjadwalan yang
                optimal.</div>

            <div class="w-100"></div>

            <div class="col-6 fw-bold fs-5">Pelayanan Pelanggan </div>
            <div class="col-6 mb-2">Memberikan layanan pelanggan yang berkualitas tinggi dengan responsif, informasi
                akurat, dan komunikasi yang baik.</div>
            <div class="col-6 fw-bold fs-5">Pertumbuhan Bisnis </div>
            <div class="col-6 mb-2">Mendukung pertumbuhan bisnis pelanggan dengan pengiriman yang tepat waktu,
                memastikan pasokan lancar dan kepuasan pelanggan.</div>
        </div>
    </section>
    <section class="container">
        <H2 class="fw-bold fs-1 mt-5"> Our <Span style="color: #962F26;">Commitment</Span> </H2>
        <hr size="5">
        <div class="row">
            <div class="col-6 fw-bold fs-5">Kecepatan</div>
            <div class="col-6 mb-2">Kami berkomitmen untuk selalu mengutamakan kecepatan dalam pengiriman. Kami akan
                selalu berupaya keras untuk memastikan barang-barang pelanggan sampai tepat waktu dan sesuai dengan
                tenggat waktu yang ditentukan.</div>
            <div class="col-6 fw-bold fs-5">Efisiensi </div>
            <div class="col-6 mb-2">Kami akan terus mengoptimalkan operasional kami untuk memberikan solusi pengiriman
                yang paling efisien. Kami berjanji untuk menggunakan rute terbaik dan teknologi canggih untuk
                meningkatkan efisiensi pengiriman.</div>

            <div class="w-100"></div>

            <div class="col-6 fw-bold fs-5">Pelayanan Pelanggan </div>
            <div class="col-6 mb-2">Pelanggan adalah prioritas kami, dan kami akan selalu memberikan layanan pelanggan
                yang terbaik. Kami akan menjadi tangkas dalam komunikasi, memberikan informasi yang akurat, dan
                menanggapi kebutuhan pelanggan dengan cepat.</div>
            <div class="col-6 fw-bold fs-5">Pertumbuhan Bisnis </div>
            <div class="col-6 mb-2">Kami akan terus mendukung pertumbuhan bisnis pelanggan kami. Dengan pengiriman yang
                tepat waktu dan andal, kami akan membantu mereka memastikan pasokan yang lancar, memperluas jangkauan
                mereka, dan memenuhi kepuasan pelanggan.</div>
        </div>
    </section>
    <section class="container">
        <h2 class="fw-bold fs-1 mt-5 mb-3 text-center" style="color: #962F26;"> Our Success Team </h2>
        <div class="owl-carousel owl-theme">
            <div class="item">
                <div class="item-content">
                    <img src="Image/Team1.jpeg" alt="Zaini">
                    <p class="text-center mt-3">
                        <span class="fw-bolder">M Zaini Ridha</span><br>
                        3312301106
                    </p>
                </div>
            </div>
            <div class="item">
                <div class="item-content">
                    <img src="Image/Team4.jpeg" alt="Sultan">
                    <p class="text-center mt-3">
                        <span class="fw-bolder">Sultan Sadad</span><br>
                        3312301102
                    </p>
                </div>
            </div>
            <div class="item">
                <div class="item-content">
                    <img src="Image/Team3.jpeg" alt="Hafivah">
                    <p class="text-center mt-3">
                        <span class="fw-bolder">Hafivah Tahta Rasyida</span><br>
                        3312301100
                    </p>
                </div>
            </div>
            <div class="item">
                <div class="item-content">
                    <img src="Image/Team2.jpeg" alt="Salma">
                    <p class="text-center mt-3">
                        <span class="fw-bolder">Salma Aulia Syahrani Ginting</span><br>
                        3312301096
                    </p>
                </div>
            </div>
            <div class="item">
                <div class="item-content">
                    <img src="https://www.w3schools.com/css/img_fjords.jpg" alt="Aziz">
                    <p class="text-center mt-3">
                        <span class="fw-bolder">M Abdull Aziz</span><br>
                        3312301119
                    </p>
                </div>
            </div>
            <div class="item">
                <div class="item-content">
                    <img src="https://www.w3schools.com/css/img_fjords.jpg" alt="Aziz">
                    <p class="text-center mt-3">
                        <span class="fw-bolder">M Abdull Aziz</span><br>
                        3312301119
                    </p>
                </div>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
<script src="main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="custom.js"></script>
<script src="Notification.js"></script>

</html>