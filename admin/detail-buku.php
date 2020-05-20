<?php
include '../config.php';
include '../koneksi.php';
include '../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:login.php");
}

//Cek apakah detail buku dibuka tanpa data id yang diberikan
if (!isset($_GET['id'])) {
    echo "<script>
            alert('Silahkan melihat data buku dari tombol detail');
            document.location.href = 'index.php';
          </script>";
    die;
}

//Ambil id buku dari url
$id = $_GET['id'];

//Cek apakah id buku ada dalam database
$cari = mysqli_query($db, "SELECT id FROM buku WHERE id = '$id'");
$row = mysqli_num_rows($cari);
//Jika row berisikan nilai 0 maka tidak ada buku yang ingin dilihat dalam database
//Kembalikan ke halaman utama
if ($row == 0) {
    echo "<script>
            alert('Buku yang ingin dilihat tidak ada dalam database, silahkan cek id buku');
            document.location.href = 'index.php';
        </script>";
    die;
}

//Ambil data buku dari tabel buku join kategori dan penerbit where id
$sql = "SELECT buku.*, kategori.nama_kategori, penerbit.nama_penerbit FROM buku
        JOIN kategori ON buku.id_kategori = kategori.id
        JOIN penerbit ON buku.id_penerbit = penerbit.id
        WHERE buku.id = '$id'";

$hasil = mysqli_query($db, $sql);
$buku = mysqli_fetch_assoc($hasil);

//Ambil data penerbit dari tabel penerbit
$sql = "SELECT id, nama_penerbit FROM penerbit";
$hasil = mysqli_query($db, $sql);
while ($data = mysqli_fetch_assoc($hasil)) {
    $penerbit[] = $data;
}

//Ambil data kategori dari tabel kategori
$sql = "SELECT id, nama_kategori FROM kategori";
$hasil = mysqli_query($db, $sql);
while ($data = mysqli_fetch_assoc($hasil)) {
    $kategori[] = $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Pintar Ilmu - Detail Buku</title>
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

        <h3 class="mt-5 mb-3 pt-2">Detail Buku</h3>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= $buku['judul'] ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $buku['tahun_terbit'] ?></h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Penulis:</b> <?= $buku['penulis'] ?></li>
                        <li class="list-group-item"><b>Penerbit:</b> <?= $buku['nama_penerbit'] ?></li>
                        <li class="list-group-item"><b>Kategori:</b> <?= $buku['nama_kategori'] ?></li>
                        <li class="list-group-item"><b>ISBN:</b> <?= $buku['isbn'] ?></li>
                    </ul>
                    <div class="card-body">
                        <a href="./" class="card-link">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="<?= BASE_URL ?>/js/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>/js/bootstrap.min.js"></script>
</body>

</html>