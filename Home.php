<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="Notification.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light navbarcolor">
    <div class="container-fluid ms-5">
      <a class="navbar-brand fw-bold fs-4" href="Home.php">SEMUT</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Home.php">Home</a>
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
  <div class="container">
    <div class="row ">
      <div class="col-4">
        <h1 class="mt-5 mb-4 fw-bolder">Menyampaikan Kebahagiaan di Setiap Harapan </h1>
        <span class="mt-5"><em>"Kami adalah mitra pengiriman andal yang mengutamakan kepuasan pelanggan, keamanan, dan
            kebahagiaan dalam setiap pengiriman. Percayakan pengiriman Anda kepada kami untuk pengalaman yang tak
            terlupakan."</em>
          <?php
          if (!isset($_SESSION['email'])) {

            echo '<a href="SignUpCustomer.php">
                  <p class="mt-5"><button type="button" class="btn btn-success"> Sign Up </button></p>
                  </a>';
          }
          ?>

        </span>
      </div>
      <div class="col"><img src="Image/gambar1.png" class="img-fluid float-end w-75" alt="gambar1"></div>
    </div>
  </div>

  <?php
  // Check if the 'email' session variable is set and not empty
  if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    echo '<div id="notificationPopup" class="notification-popup">';
    echo '    <div id="notificationPopupContent"></div>';
    echo '    <button id="closeNotificationPopup" class="btn btn-light mt-2">Tutup</button>';
    echo '</div>';
  }
  ?>

  <footer class="bg-white">
    <div class="container my-0">
      <p>&copy;PBL Politeknik Negeri Batam 2023</p>
    </div>
  </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
  integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
  integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="Notification.js"></script>

</html>