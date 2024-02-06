<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="customeregister.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1 class="mt-4 fw-bolder">Sign up to </h1>
                <h1 class="mb-5 fw-bolder fs-2">Welcome to our colony</h1>
                <span class="mt-4">If you have an account</span>
                <p> You Can <a href="SignInCustomer.php" style="text-decoration: none;" class="fw-bold">Log In Here !</a></p>
            </div>
            <div class="img col-3 mt-4"><img src="Image/Frame.png" alt="Logo" style="width: 400px;"></div>
            <div class="col-5">
                <h4 class="mt-4 mb-4 fw-bold">Sign Up </h4>
                <form action="ProsesRegisterCustomer.php" method="POST">
                    <div class="mt-2">
                        <label for="nama" class="form-label mb-1">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mt-2">
                        <label for="email" class="form-label mb-1">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mt-2">
                        <label for="alamat" class="form-label mb-1">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="mt-2">
                        <label for="no_telepon" class="form-label mb-1">No Telepon</label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
                    </div>
                    <div class="mt-2">
                        <label for="jenis_kelamin" class="form-label mb-1">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="Password" class="form-label mb-1">Password </label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <i class="far fa-eye password-toggle" id="show-password" onclick="togglePassword()"></i>
                    </div>
                    <div class="mt-2">
                        <label for=" Confirm Password" class="form-label mb-1"> Konfirmasi Password </label>
                        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password"
                            required>
                        <i class="far fa-eye password-toggle1" id="show-password1" onclick="toggle1Password()"></i>
                    </div>
                    <a href="Login.html"><button type="submit" class="mt-5 btn btn-primary"
                            style="width: 450px;">Register</button></a>
                </form>
            </div>
        </div>
        <footer class="footer-container">
            <div class="container mt-auto">
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
<script src="Password.js"></script>

</html>