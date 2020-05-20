<?php
include '../../config.php';
include '../../koneksi.php';
include '../../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:" . BASE_URL . "/login.php");
}

//Cek apakah user tidak sengaja membuka ubah php tanpa mengirimkan data
//Jika tidak ada data yang dikirimkan maka kembalikan ke halaman utama
if (!isset($_GET['id'])) {
    echo "<script>
            alert('Silahkan mengubah kategori dari tombol ubah');
            document.location.href = 'index.php';
          </script>";
    die;
}

//Ambil id dari url
$id = $_GET['id'];

//Cek apakah id kategori ada dalam database
$cari = mysqli_query($db, "SELECT id FROM kategori WHERE id = '$id'");
$row = mysqli_num_rows($cari);
//Jika row berisikan nilai 0 maka tidak ada kategori yang ingin diubah dalam database
//Kembalikan ke halaman utama
if ($row == 0) {
    echo "<script>
            alert('Kategori yang ingin diubah tidak ada dalam database, silahkan cek id kategori');
            document.location.href = 'index.php';
        </script>";
    die;
}

//Ketika form sudah disubmit
if (isset($_POST['submit'])) {

    $nama_kategori = htmlspecialchars($_POST['nama_kategori']);
    $keterangan = htmlspecialchars($_POST['keterangan']);

    $sql = "UPDATE kategori SET
            nama_kategori = '$nama_kategori',
            keterangan = '$keterangan'
            WHERE id = '$id'";

    $ubah = mysqli_query($db, $sql);
    if (!$ubah) {
        echo mysqli_error($db);
        die;
    }
    echo "<script>
            alert('Kategori berhasil diubah');
            document.location.href = 'index.php';
          </script>";
}

//Ambil data kategori dari tabel kategori
$sql = "SELECT * FROM kategori WHERE id = '$id'";
$hasil = mysqli_query($db, $sql);
$kategori = mysqli_fetch_assoc($hasil);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Pintar Ilmu - Ubah Kategori</title>
    <link rel="icon" href="<?= BASE_URL ?>/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">Perpustakaan Pintar Ilmu</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigasiMain" aria-controls="navigasiMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigasiMain">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="./">Kembali</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-3">

        <h3 class="mt-5 mb-3 pt-2 text-center">Form Ubah Kategori</h3>

        <form action="" method="post">
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" value="<?= $kategori['nama_kategori'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input class="form-control" type="text" name="keterangan" id="keterangan" value="<?= $kategori['keterangan'] ?>" required>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Ubah Kategori</button>
            <a href="index.php" class="btn btn-warning">Batal</a>
        </form>
    </div>
    <script src="<?= BASE_URL ?>/js/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>/js/bootstrap.min.js"></script>
</body>

</html>