<?php
include 'koneksi.php';
include 'functions.php';

session_start();

if (isLogin()) {
    header("Location:index.php");
}

if (isset($_POST['register'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    if ($password != $password1) {
        $error_pass = true;
    } else if (register($username, $password, $nama)) {
        $register_success = true;
    } else {
        $error_username = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Pintar Ilmu - Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">Perpustakaan Pintar Ilmu</a>
        </div>
    </nav>

    <div class="container py-3">

        <h3 class="mt-5 mb-3 pt-2 text-center">Register User Perpustakaan</h3>

        <form action="" method="post">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <?php if (isset($error_username)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Register gagal!</strong> username sudah ada yang menggunakan.
                        </div>
                    <?php endif; ?>
                    <?php if (isset($error_pass)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Register gagal!</strong> confirm password tidak sama.
                        </div>
                    <?php endif; ?>
                    <?php if (isset($register_success)) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Register berhasil!</strong> silahkan login untuk masuk.
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" type="text" name="nama" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input class="form-control" type="password" name="password1" id="confirm_password" required>
                    </div>
                    <button class="btn btn-primary" type="submit" name="register">Register</button>
                    <button class="btn btn-danger" type="reset">Reset</button>

                    <p class="mt-3">Sudah punya akun? <a href="login.php">Login</a></p>
                </div>
            </div>
        </form>

    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>