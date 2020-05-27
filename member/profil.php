<?php
session_start();
include '../koneksi.php';
include '../functions.php';

//Cek apakah sudah login dan member
if (!isLogin() || !isMember()) {
    header('Location:../login.php');
}

if (isset($_POST['submit_profil'])) {
    $username = $_SESSION['login'];
    $sql = "SELECT id FROM users WHERE username = '$username'";
    $id = mysqli_fetch_assoc(mysqli_query($db, $sql))['id'];

    $new_username = htmlspecialchars($_POST['username']);
    $new_nama = htmlspecialchars($_POST['nama']);
    $sql = "UPDATE users 
            SET username = '$new_username', nama = '$new_nama'
            WHERE id = '$id'";
    mysqli_query($db, $sql);
    $_SESSION['login'] = $new_username;
    $sukses_profil = true;
}

if (isset($_POST['submit_password'])) {
    $username = $_SESSION['login'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $data = mysqli_fetch_assoc(mysqli_query($db, $sql));
    $id = $data['id'];

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $new_password_confirmation = $_POST['new_password_confirmation'];

    //Cek apakah konfirmasi password sama
    if ($new_password != $new_password_confirmation) {
        $error_pass_confirm = true;
    } else {
        if (!password_verify($current_password, $data['password'])) {
            $error_current_password = true;
        } else {
            $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE users 
            SET password = '$hash_password'
            WHERE id = '$id'";
            mysqli_query($db, $sql);
            $sukses_password = true;
        }
    }
}

//Ambil data user
$username = $_SESSION['login'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$data = mysqli_fetch_assoc(mysqli_query($db, $sql));

$title = 'Profil';
?>
<?php include 'header.php' ?>
<div class="container py-3">
    <h3 class="mt-5 pt-2">Profil</h3>
    <hr>
    <h4><?= $data['nama'] ?></h4>
    <small>ID Member: <?= $data['id'] ?></small>
    <hr>
    <div class="row mt-3">
        <div class="col-sm-6">
            <?php if (isset($sukses_profil)) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Profil berhasil diubah!.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <h5>Edit profil</h5>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>">
                </div>
                <button class="btn btn-primary" type="submit" name="submit_profil">Edit Profil</button>
            </form>
        </div>
        <div class="col-sm-6">
            <?php if (isset($error_pass_confirm)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Konfirmasi password tidak sama!.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php if (isset($error_current_password)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password sekarang salah!.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php if (isset($sukses_password)) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Password berhasil diubah!.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <h5>Ubah password</h5>
            <form action="" method="post">
                <div class="form-group">
                    <label for="current_password">Password sekarang</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                </div>
                <button class="btn btn-primary" type="submit" name="submit_password">Ubah password</button>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>