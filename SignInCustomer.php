<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="customlogin.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1 class="mt-4 fw-bolder">Sign in to </h1>
                <h1 class="mb-5 fw-bolder fs-2">Welcome back anters </h1>
                <span class="mt-4">If you don’t have an account register</span>
                <p> You Can <a href="SignUpCustomer.php" style="text-decoration: none;" class="fw-bold">Register Here
                        !</a>
                </p>
            </div>
            <div class="img col-3 mt-4"><img src="Image/Frame.png" alt="Logo" style="width: 400px;"></div>
            <div class="col-5">
                <form action="ProsesLogInCustomer.php" method="POST">
                    <h4 class="mt-4 mb-4 fw-bold">Sign In</h4>
                    <div>
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Input Your Email" required>
                        <div class="mt-3">
                            <label for="Password" class="form-label">Password </label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Input Your Password"
                                required>
                            <i class="far fa-eye password-toggle" id="show-password" onclick="togglePassword()"></i>
                        </div>
                        <p class="forgot-password text-end"><a href="#"
                                style="text-decoration: none; color: #B0B0B0;">Forgot Password?</a></p>
                        <button type="submit" class="mt-3 btn btn-primary" style="width: 450px;">Login</button>
                    </div>
            </div>
            </form>
        </div>
        <footer class="footer-container">
            <div class="container mt-5">
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