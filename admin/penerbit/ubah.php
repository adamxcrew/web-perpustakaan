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
            alert('Silahkan mengubah penerbit dari tombol ubah');
            document.location.href = 'index.php';
          </script>";
}

//Ambil id dari url
$id = $_GET['id'];

//Cek apakah id penerbit ada dalam database
$cari = mysqli_query($db, "SELECT id FROM penerbit WHERE id = '$id'");
$row = mysqli_num_rows($cari);
//Jika row berisikan nilai 0 maka tidak ada penerbit yang ingin diubah dalam database
//Kembalikan ke halaman utama
if ($row == 0) {
    echo "<script>
            alert('Penerbit yang ingin diubah tidak ada dalam database, silahkan cek id penerbit');
            document.location.href = 'index.php';
        </script>";
    die;
}

//Ketika form sudah disubmit
if (isset($_POST['submit'])) {

    $nama_penerbit = htmlspecialchars($_POST['nama_penerbit']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telp = htmlspecialchars($_POST['no_telp']);

    $sql = "UPDATE penerbit SET
            nama_penerbit = '$nama_penerbit',
            alamat = '$alamat',
            no_telp = '$no_telp'
            WHERE id = '$id'";

    $ubah = mysqli_query($db, $sql);
    if (!$ubah) {
        echo mysqli_error($db);
        die;
    }
    echo "<script>
            alert('Penerbit berhasil diubah');
            document.location.href = 'index.php';
          </script>";
}

//Ambil data penerbit dari tabel penerbit
$sql = "SELECT * FROM penerbit WHERE id = '$id'";
$hasil = mysqli_query($db, $sql);
$penerbit = mysqli_fetch_assoc($hasil);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Pintar Ilmu - Ubah Penerbit</title>
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

        <h3 class="mt-5 mb-3 pt-2 text-center">Form Ubah Penerbit</h3>

        <form action="" method="post">
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label for="nama_penerbit">Nama Penerbit</label>
                        <input class="form-control" type="text" name="nama_penerbit" id="nama_penerbit" value="<?= $penerbit['nama_penerbit'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input class="form-control" type="text" name="alamat" id="alamat" value="<?= $penerbit['alamat'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telp</label>
                        <input class="form-control" type="number" name="no_telp" id="no_telp" value="<?= $penerbit['no_telp'] ?>" required>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Ubah Penerbit</button>
            <a href="index.php" class="btn btn-warning">Batal</a>
        </form>
    </div>
    <script src="<?= BASE_URL ?>/js/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>/js/bootstrap.min.js"></script>
</body>

</html>