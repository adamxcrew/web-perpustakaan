<?php
include 'koneksi.php';
include 'functions.php';

session_start();

if (isLogin()) {
    if ($_SESSION['role'] == 1) {
        header("Location:admin/index.php");
    } else {
        header("Location:member/index.php");
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = login($username, $password);
    if ($login == 1) {
        $_SESSION['login'] = $username;
        $_SESSION['role'] = 1;
        header("Location:admin/index.php");
    } else if ($login == 2) {
        $_SESSION['login'] = $username;
        $_SESSION['role'] = 2;
        header("Location:member/index.php");
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Pintar Ilmu - Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">Perpustakaan Pintar Ilmu</a>
        </div>
    </nav>

    <div class="container py-3">

        <h3 class="mt-5 mb-3 pt-2 text-center">Login Perpustakaan</h3>

        <form action="" method="post">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Login gagal!</strong> username atau password salah.
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit" name="login">Login</button>
                    <button class="btn btn-danger" type="reset">Reset</button>

                    <p class="mt-3">Belum punya akun? <a href="register.php">Register</a></p>
                </div>
            </div>
        </form>

    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>