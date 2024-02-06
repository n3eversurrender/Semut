<?php session_start();


include("inc.koneksi.php");
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
$harga1km = $harga[6];
$harga1kg = $harga[7];
$hargaLayananCepat = $harga[8];
$hargaLayananTerjadwal = $harga[9];
$hargaShipCargo = $harga[10];


if (!isset($_SESSION['email'])) {
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
  <title>Price Estimation</title>
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

  <div class="row mt-5"></div>
  <div class="row mt-5"></div>
  <div class="container">
    <h1 class="fw-bold">Daftar Harga Pengiriman</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Jenis Layanan</th>
          <th scope="col">Harga</th>
          <th scope="col">Jarak tempuh</th>
          <th scope="col">Harga</th>
          <th scope="col">Berat Barang</th>
          <th scope="col">Harga</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Layanan Transportasi Minivans</td>
          <td>Rp.
            <?php echo number_format($hargaMinivans, 0, ',', '.'); ?>
          </td>
          <td>1 Km</td>
          <td>Rp.
            <?php echo number_format($harga1km, 0, ',', '.'); ?>
          </td>
          <td>1 kg</td>
          <td>Rp.
            <?php echo number_format($harga1kg, 0, ',', '.'); ?>
          </td>
        </tr>
        <tr>
          <td>Layanan Transportasi Truck Cargo</td>
          <td>Rp.
            <?php echo number_format($hargaTruckCargo, 0, ',', '.'); ?>
          </td>
          <td>2 Km</td>
          <td>Rp.
            <?php echo number_format($harga1km * 2, 0, ',', '.'); ?>
          </td>
          <td>2 kg</td>
          <td>Rp.
            <?php echo number_format($harga1kg * 2, 0, ',', '.'); ?>
          </td>
        </tr>
        <tr>
          <td>Layanan Transportasi Carry Pickup</td>
          <td>Rp.
            <?php echo number_format($hargaCarryPickup, 0, ',', '.'); ?>
          </td>
          <td>3 Km</td>
          <td>Rp.
            <?php echo number_format($harga1km * 3, 0, ',', '.'); ?>
          </td>
          <td>3 kg</td>
          <td>Rp.
            <?php echo number_format($harga1kg * 3, 0, ',', '.'); ?>
          </td>
        </tr>
        <tr>
          <td>Layanan Transportasi Ship Cargo</td>
          <td>Rp.
            <?php echo number_format($hargaShipCargo, 0, ',', '.'); ?>
          </td>
          <td>4 Km</td>
          <td>Rp.
            <?php echo number_format($harga1km * 4, 0, ',', '.'); ?>
          </td>
          <td>4 kg</td>
          <td>Rp.
            <?php echo number_format($harga1kg * 4, 0, ',', '.'); ?>
          </td>
        </tr>
        <tr>
          <td>Layanan Transportasi Plane Express</td>
          <td>Rp.
            <?php echo number_format($hargaPlaneExpress, 0, ',', '.'); ?>
          </td>
          <td>5 Km</td>
          <td>Rp.
            <?php echo number_format($harga1km * 5, 0, ',', '.'); ?>
          </td>
          <td>5 kg</td>
          <td>Rp.
            <?php echo number_format($harga1kg * 5, 0, ',', '.'); ?>
          </td>
        </tr>
        <tr>
          <td>Layanan Transportasi Motor</td>
          <td>Rp.
            <?php echo number_format($hargaMotor, 0, ',', '.'); ?>
          </td>
          <td>6 Km</td>
          <td>Rp.
            <?php echo number_format($harga1km * 6, 0, ',', '.'); ?>
          </td>
          <td>6 kg</td>
          <td>Rp.
            <?php echo number_format($harga1kg * 6, 0, ',', '.'); ?>
          </td>
        </tr>
        <tr>
          <td>Layanan Pengiriman Cepat</td>
          <td>Rp.
            <?php echo number_format($hargaLayananCepat, 0, ',', '.'); ?>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Layanan Pengiriman Terjadwal</td>
          <td>Rp.
            <?php echo number_format($hargaLayananTerjadwal, 0, ',', '.'); ?>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <div class="container mt-5">
      <div class="row">
        <div class="img col-md-7">
          <img src="Image/E4.jpg" alt="Logo" class="w-100">
        </div>
        <div class="col-md-5">
          <h1 class="fw-bold">Calcullator Pengiriman</h1>
          <div class="mt-3 mb-3">
            <div class="input-group">
              <label for="jarak" class="form-label">Jarak (km):</label>
              <input min="0" type="number" class="form-control" id="jarak" placeholder="Masukkan jarak dalam kilometer"
                oninput="validateJarak(this)">
              <div id="jarakAlert" class="alert alert-danger mt-2" style="display: none;">Jarak harus diisi.</div>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <label for="berat" class="form-label">Berat Barang (kg):</label>
              <input min="0" type="number" class="form-control" id="berat"
                placeholder="Masukkan berat barang dalam kilogram" oninput="validateBerat(this)">
              <div id="beratAlert" class="alert alert-danger mt-2" style="display: none;">Berat harus diisi.</div>
            </div>
          </div>


          <div class="mt-3 mb-3">
            <div class="input-group">
              <select class="form-select" id="transportasi" name="transportasi" required>
                <option value="" disabled selected>Layanan Transportasi</option>
                <option value="Minivans">Minivans</option>
                <option value="Truck Cargo">Truck Cargo</option>
                <option value="Carry Pickup">Carry Pickup</option>
                <option value="Ship Cargo">Ship Cargo</option>
                <option value="Plane Express">Plane Express</option>
                <option value="Motor">Motor</option>
              </select>
              <select class="form-select" id="layanan_kurir" name="layanan_kurir" required>
                <option value="" disabled selected>Pilih Layanan Kurir</option>
                <option value="cepat">Layanan Cepat</option>
                <option value="terjadwal">Layanan Terjadwal</option>
              </select>
            </div>
            <div class="mt-3">
              <input type="date" class="form-control" id="tanggal_terjadwal" name="tanggal_terjadwal" disabled>
            </div>
          </div>

          <button class="btn btn-primary" onclick="hitungHarga()">Hitung Harga</button>
          <button class="btn btn-secondary" onclick="resetInput()">Reset</button>
          <p id="hasilHarga"></p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
      integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="custom.js"></script>
    <script src="Notification.js"></script>
    <script>
      function hitungHarga() {
        // Mendapatkan nilai jarak, berat barang, dan jenis transportasi dari input
        var jarak = parseFloat(document.getElementById("jarak").value);
        var berat = parseFloat(document.getElementById("berat").value);
        var transportasi = document.getElementById("transportasi").value;
        var layananKurir = document.getElementById("layanan_kurir").value;

        // Cek apakah input jarak, berat, atau jenis transportasi kosong
        if (isNaN(jarak) || isNaN(berat) || transportasi === "" || layananKurir === "") {
          document.getElementById("jarakAlert").style.display = isNaN(jarak) ? "block" : "none";
          document.getElementById("beratAlert").style.display = isNaN(berat) ? "block" : "none";
          // Sembunyikan elemen hasil jika input tidak lengkap
          document.getElementById("hasilHarga").style.display = "none";
          return;
        }

        // Harga sesuai dengan jenis transportasi
        var hargaTransportasi = 0; // Anda perlu menentukan harga transportasi sesuai dengan jenis transportasi yang dipilih

        // Harga untuk setiap jenis transportasi
        var hargaMinivans = 150000; // Misalnya, harga untuk Minivans adalah 50.000
        var hargaTruckCargo = 200000; // Misalnya, harga untuk Truck Cargo adalah 70.000
        var hargaCarryPickup = 100000; // Misalnya, harga untuk Carry Pickup adalah 45.000
        var hargaShipCargo = 3500000; // Misalnya, harga untuk Ship Cargo adalah 100.000
        var hargaPlaneExpress = 1200000; // Misalnya, harga untuk Plane Express adalah 120.000
        var hargaMotor = 50000; // Misalnya, harga untuk Motor adalah 20.000

        // Variabel untuk menyimpan harga layanan transportasi yang dipilih
        var hargaLayananTransportasi = 0;

        // Harga tambahan untuk layanan cepat atau terjadwal
        var hargaLayanan = 0;
        if (layananKurir === "cepat") {
          hargaLayanan = 25000; // Biaya layanan cepat
        } else if (layananKurir === "terjadwal") {
          hargaLayanan = 30000; // Biaya layanan terjadwal
        }

        // Menghitung harga pengiriman berdasarkan jarak
        var hargaJarak = jarak * 10000;

        // Menghitung harga pengiriman berdasarkan berat barang
        var hargaBerat = berat * 5000;

        // Menentukan harga transportasi berdasarkan jenis transportasi yang dipilih
        switch (transportasi) {
          case "Minivans":
            hargaTransportasi = hargaMinivans;
            break;
          case "Truck Cargo":
            hargaTransportasi = hargaTruckCargo;
            break;
          case "Carry Pickup":
            hargaTransportasi = hargaCarryPickup;
            break;
          case "Ship Cargo":
            hargaTransportasi = hargaShipCargo;
            break;
          case "Plane Express":
            hargaTransportasi = hargaPlaneExpress;
            break;
          case "Motor":
            hargaTransportasi = hargaMotor;
            break;
          default:
            hargaTransportasi = 0; // Harga default jika tidak ada pilihan yang sesuai
        }

        // Menghitung total harga pengiriman
        var totalHarga = hargaJarak + hargaBerat + hargaTransportasi + hargaLayanan;

        // Menampilkan hasil harga dengan format Rp xx,xxx,xxx
        var formattedHarga = totalHarga.toLocaleString('id-ID', {
          style: 'currency',
          currency: 'IDR'
        });

        // Menampilkan hasil harga beserta rincian
        var pesanRincian = "Harga yang harus dibayar dengan menggunakan metode pengiriman " + layananKurir + " menggunakan layanan transportasi " + transportasi + " dengan jarak tempuh " + jarak + " km dan berat " + berat + " kg adalah = <strong>" + formattedHarga + "</strong>";
        // ...

        // Menampilkan elemen hasil dan isi pesan rincian
        document.getElementById("hasilHarga").style.display = "block";
        document.getElementById("hasilHarga").innerHTML = pesanRincian;

        // Jika input sudah diisi, hilangkan pesan peringatan
        document.getElementById("jarakAlert").style.display = "none";
        document.getElementById("beratAlert").style.display = "none";
      }

      document.getElementById("layanan_kurir").addEventListener("change", function () {
        var tanggalTerjadwal = document.getElementById("tanggal_terjadwal");

        if (this.value === "terjadwal") {
          tanggalTerjadwal.disabled = false; // Aktifkan masukan tanggal
        } else {
          tanggalTerjadwal.disabled = true; // Matikan masukan tanggal
        }
      });

      // Tambahan kode untuk menentukan hargaTransportasi
      var jenisTransportasiDropdown = document.getElementById("transportasi");

      jenisTransportasiDropdown.addEventListener("change", function () {
        var jenisTransportasi = jenisTransportasiDropdown.value;

        // Menentukan harga transportasi berdasarkan jenis transportasi yang dipilih
        switch (jenisTransportasi) {
          case "Minivans":
            hargaTransportasi = hargaMinivans;
            break;
          case "Truck Cargo":
            hargaTransportasi = hargaTruckCargo;
            break;
          case "Carry Pickup":
            hargaTransportasi = hargaCarryPickup;
            break;
          case "Ship Cargo":
            hargaTransportasi = hargaShipCargo;
            break;
          case "Plane Express":
            hargaTransportasi = hargaPlaneExpress;
            break;
          case "Motor":
            hargaTransportasi = hargaMotor;
            break;
          default:
            hargaTransportasi = 0; // Harga default jika tidak ada pilihan yang sesuai
        }

        console.log("Harga transportasi untuk " + jenisTransportasi + ": " + hargaTransportasi);
      });

    </script>

    <script>
      function validateJarak(input) {
        var jarakValue = input.value;
        var jarakAlert = document.getElementById('jarakAlert');

        if (jarakValue === '') {
          jarakAlert.style.display = 'block';
        } else {
          jarakAlert.style.display = 'none';
        }
      }

      function validateBerat(input) {
        var beratValue = input.value;
        var beratAlert = document.getElementById('beratAlert');

        if (beratValue === '') {
          beratAlert.style.display = 'block';
        } else {
          beratAlert.style.display = 'none';
        }
      }
    </script>

</body>

</html>