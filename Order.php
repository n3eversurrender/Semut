<?php session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['is_customer'])) {
  // Jika tidak ada sesi email, arahkan ke halaman login
  header("Location: SignInCustomer.php");
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
  <title>Order</title>
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
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
      <div class="img col-md-7 mt-4 d-flex align-items-center">
        <img src="Image/Order Image.png" alt="Logo" class="w-75">
      </div>

      <div class="col-md-5">
        <h2 class="mt-4 mb-4 fw-bold">Order</h2>
        <form action="Order_Konfirmasi.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="status" value="1"> <!-- Status pesanan "Checking" -->
          <input type="hidden" name="status_pembayaran" value="0"> <!-- Status pesanan "Checking" -->

          <div class="mt-3">
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang"
              required>
          </div>
          <div class="mt-3">
            <input type="text" class="form-control" id="alamat_penjemputan" name="alamat_penjemputan"
              placeholder="Alamat Penjemputan" required>
          </div>
          <div class="mt-3">
            <input type="text" class="form-control" id="alamat_penerima" name="alamat_penerima"
              placeholder="Alamat Penerima" required>
          </div>
          <div class="mt-3">
            <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telepon" required>
          </div>
          <div class="mt-3 mb-3">
            <div class="input-group">
              <select class="form-select" id="transportasi" name="transportasi" onchange="hitungHarga()" required>
                <option value="" disabled selected>Layanan Transportasi</option>
                <option value="Minivans">Minivans</option>
                <option value="Truck Cargo">Truck Cargo</option>
                <option value="Carry Pickup">Carry Pickup</option>
                <option value="Ship Cargo">Ship Cargo</option>
                <option value="Plane Express">Plane Express</option>
                <option value="Motor">Motor</option>
              </select>
              <select class="form-select" id="layanan_kurir" name="layanan_kurir" onchange="hitungHarga()" required>
                <option value="" disabled selected>Pilih Layanan Kurir</option>
                <option value="cepat">Layanan Cepat</option>
                <option value="terjadwal">Layanan Terjadwal</option>
              </select>
            </div>
          </div>

          <div class="mt-3 mb-3">
            <input type="date" class="form-control" id="tanggal_terjadwal" name="tanggal_terjadwal" disabled>
          </div>

          <div class="mt-3 mb-3">
            <div class="input-group">
              <input min="0" type="number" class="form-control" id="berat" name="berat" placeholder="Berat (kg)"
                required><input min="0" type="number" class="form-control" id="jarak" name="jarak"
                placeholder="Jarak (km)" required>
            </div>
          </div>

          <div class="mt-3 mb-3">
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
          </div>
          <div class="mt-3 mb-3">
            <span id="harga_display"></span>
          </div>
          <input type="hidden" name="harga" id="harga" value="">
          <button type="submit" name="submit" class="form-control mt-3 btn btn-outline-secondary">Pesan
            Sekarang</button>
        </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
  integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="custom.js"></script>
<script src="Notification.js"></script>
<script>
  function hitungHarga() {
    var berat = parseFloat(document.getElementById("berat").value) || 0; // Mengatasi masalah jika berat tidak diisi
    var jarak = parseInt(document.getElementById("jarak").value) || 0; // Mengatasi masalah jika jarak tidak diisi
    var transportasi = document.getElementById("transportasi").value;
    var layananKurir = document.getElementById("layanan_kurir").value;
    var harga_display = document.getElementById("harga_display");

    // Harga per kilogram
    var hargaPerKg = 5000;

    // Biaya per kilometer
    var biayaPerKm = 10000;

    // Tambahkan logika untuk menghitung harga berdasarkan layanan transportasi, berat, dan jarak yang dipilih
    var harga;

    switch (transportasi) {
      case "Minivans":
        harga = (berat * hargaPerKg) + (jarak * biayaPerKm) + 150000;
        break;
      case "Truck Cargo":
        harga = (berat * hargaPerKg) + (jarak * biayaPerKm) + 200000;
        break;
      case "Carry Pickup":
        harga = (berat * hargaPerKg) + (jarak * biayaPerKm) + 100000;
        break;
      case "Ship Cargo":
        harga = (jarak * biayaPerKm) + 3500000; // Harga tetap untuk jarak
        break;
      case "Plane Express":
        harga = (jarak * biayaPerKm) + 1200000; // Harga tetap untuk jarak
        break;
      case "Motor":
        harga = (berat * hargaPerKg) + (jarak * biayaPerKm) + 50000;
        break;

      default:
        harga = 0; // Nilai default jika layanan tidak dipilih
    }

    // Tambahkan logika untuk harga layanan kurir
    if (layananKurir === "cepat") {
      harga += 25000; // Harga layanan cepat
    } else if (layananKurir === "terjadwal") {
      harga += 30000; // Harga layanan terjadwal
    }

    // Set nilai elemen input tersembunyi "harga"
    document.getElementById("harga").value = harga;

    // Tampilkan harga yang dihitung
    if (!isNaN(harga) && harga > 0) {
      harga_display.textContent = "Total Harga yang Harus Dibayar: Rp. " + harga.toLocaleString();
    } else {
      harga_display.textContent = "Total Harga yang Harus Dibayar: Tidak valid";
    }
  }

  // Tambahkan event listener untuk memastikan perhitungan harga segera diupdate ketika nilai berat berubah
  document.getElementById("berat").addEventListener("input", hitungHarga);

  // Tambahkan event listener untuk memastikan perhitungan harga segera diupdate ketika nilai jarak berubah
  document.getElementById("jarak").addEventListener("input", hitungHarga);

  // Tambahkan event listener untuk memastikan perhitungan harga segera diupdate ketika nilai transportasi berubah
  document.getElementById("transportasi").addEventListener("change", hitungHarga);

  // Tambahkan event listener untuk memastikan perhitungan harga segera diupdate ketika nilai layanan kurir berubah
  document.getElementById("layanan_kurir").addEventListener("change", hitungHarga);

  // Tambahkan event listener untuk memastikan perhitungan harga segera diupdate ketika nilai tanggal terjadwal berubah
  document.getElementById("tanggal_terjadwal").addEventListener("input", hitungHarga);

  document.getElementById("layanan_kurir").addEventListener("change", function () {
    var tanggalTerjadwal = document.getElementById("tanggal_terjadwal");

    if (this.value === "terjadwal") {
      tanggalTerjadwal.disabled = false; // Aktifkan masukan tanggal
    } else {
      tanggalTerjadwal.disabled = true; // Matikan masukan tanggal
    }
  });
</script>

</html>