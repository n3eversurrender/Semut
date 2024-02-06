<?php
session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['is_customer'])) {
    // Jika tidak ada sesi email, arahkan ke halaman login
    header("Location: SignInCustomer.php");
    exit();
}

// Dapatkan email pengguna dari sesi
$email = $_SESSION['email'];

// Fetch user data from the database
include("inc.koneksi.php");
$sql = "SELECT * FROM `customer` WHERE `email` = '$email'";
$query = mysqli_query($koneksi, $sql);

// Check if the query was successful
if ($query) {
    $user = mysqli_fetch_assoc($query);
} else {
    echo "Error in fetching user data: " . mysqli_error($koneksi);
}

// Close the database connection
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Notification.css">
    <style>
        .profile-info {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin: auto;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Tambahkan baris ini untuk bayangan */
        }

        .profile-picture {
            border-radius: 50%;
            max-width: 100%;
            max-height: 200px;
            height: auto;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Tambahkan baris ini untuk bayangan */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbarcolor">
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

                        // Divider
                    
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

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 profile-info">
                <div class="d-flex justify-content-center">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($user['Foto']); ?>" alt="Foto Profil"
                        class="img-fluid profile-picture">
                </div>

                <div class="profile-details mt-3">
                    <table class="table">
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>:
                                <?php echo $user['Nama']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:
                                <?php echo $user['Email']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>:
                                <?php echo $user['No_Telepon']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>:
                                <?php echo $user['Alamat']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>:
                                <?php echo $user['Jenis_Kelamin']; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                    data-bs-target="#editProfileModal">Edit Profil</button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi formulir pengeditan profil di sini -->
                    <form id="editProfileForm" action="Profile_Edit.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td><label for="editNama" class="form-label mt-3 fw-bold">Nama Lengkap</label></td>
                                <td><input type="text" class="form-control mt-3" id="editNama" name="editNama"
                                        value="<?php echo $user['Nama']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label for="editEmail" class="form-label mt-3 fw-bold">Email</label></td>
                                <td><input type="email" class="form-control mt-3" id="editEmail" name="editEmail"
                                        value="<?php echo $user['Email']; ?>" readonly></td>
                            </tr>
                            <tr>
                                <td><label for="editNoTelepon" class="form-label mt-3 fw-bold">No Telepon</label></td>
                                <td><input type="tel" class="form-control mt-3" id="editNoTelepon" name="editNoTelepon"
                                        value="<?php echo $user['No_Telepon']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label for="editAlamat" class="form-label mt-3 fw-bold">Alamat</label></td>
                                <td><textarea class="form-control mt-3" id="editAlamat"
                                        name="editAlamat"><?php echo $user['Alamat']; ?></textarea></td>
                            </tr>
                            <tr>
                                <td><label for="editJenisKelamin" class="form-label mt-3 fw-bold">Jenis Kelamin</label>
                                </td>
                                <td>
                                    <select class="form-select mt-3" id="editJenisKelamin" name="editJenisKelamin">
                                        <option value="Laki-laki" <?php echo ($user['Jenis_Kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                        <option value="Perempuan" <?php echo ($user['Jenis_Kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="changeProfilePicture" class="form-label mt-3 fw-bold">Pilih Foto Profil
                                        Baru</label></td>
                                <td><input type="file" class="form-control mt-3" id="changeProfilePicture"
                                        name="changeProfilePicture" accept="image/*"></td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-primary mt-5">Simpan Perubahan</button>
                    </form>

                </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
    integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="Notification.js"></script>

</html>