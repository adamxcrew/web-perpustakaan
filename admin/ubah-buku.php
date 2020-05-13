<?php
include '../config.php';
include '../koneksi.php';
include '../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:login.php");
}

//Cek apakah ubah buku dibuka tanpa data id yang diberikan
if (!isset($_GET['id'])) {
    echo "<script>
            alert('Silahkan mengubah data buku dari tombol ubah');
            document.location.href = 'index.php';
          </script>";
    die;
}

//Ambil id buku yang ingin diubah dari url
$id = $_GET['id'];

//Cek apakah id buku ada dalam database
$cari = mysqli_query($db, "SELECT id FROM buku WHERE id = '$id'");
$row = mysqli_num_rows($cari);
//Jika row berisikan nilai 0 maka tidak ada buku yang ingin diubah dalam database
//Kembalikan ke halaman utama
if ($row == 0) {
    echo "<script>
            alert('Buku yang ingin diubah tidak ada dalam database, silahkan cek id buku');
            document.location.href = 'index.php';
          </script>";
    die;
}

//Ketika form sudah disubmit
if (isset($_POST['submit'])) {

    $judul = htmlspecialchars($_POST['judul']);
    $penerbit = htmlspecialchars($_POST['penerbit']);
    $tahun = htmlspecialchars($_POST['tahun']);
    $penulis = htmlspecialchars($_POST['penulis']);
    $isbn = htmlspecialchars($_POST['isbn']);
    $kategori = htmlspecialchars($_POST['kategori']);

    $sql = "UPDATE buku SET
            judul = '$judul',
            id_penerbit = '$penerbit',
            tahun_terbit = '$tahun',
            penulis = '$penulis',
            isbn = '$isbn',
            id_kategori = '$kategori'
            WHERE id = '$id'";

    $ubah = mysqli_query($db, $sql);
    if (!$ubah) {
        echo mysqli_error($db);
        die;
    }
    echo "<script>
            alert('Buku berhasil diubah');
            document.location.href = 'index.php';
          </script>";
}

//Ambil data buku dari tabel buku 
$sql = "SELECT * FROM buku WHERE id = '$id'";
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
    <title>Perpustakaan Pintar Ilmu - Ubah Buku</title>
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

        <h3 class="mt-5 mb-3 pt-2 text-center">Form Ubah Buku</h3>

        <form action="" method="post">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="judul">Judul Buku</label>
                        <input class="form-control" type="text" name="judul" id="judul" value="<?= $buku['judul'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <select class="form-control" name="penerbit" id="penerbit">
                            <?php foreach ($penerbit as $p) : ?>
                                <?php if ($p['id'] == $buku['id_penerbit']) : ?>
                                    <option value="<?= $p['id'] ?>" selected><?= $p['nama_penerbit'] ?></option>
                                <?php else : ?>
                                    <option value="<?= $p['id'] ?>"><?= $p['nama_penerbit'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun Terbit</label>
                        <input class="form-control" type="number" name="tahun" id="tahun" value="<?= $buku['tahun_terbit'] ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input class="form-control" type="text" name="penulis" id="penulis" value="<?= $buku['penulis'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input class="form-control" type="text" name="isbn" id="isbn" value="<?= $buku['isbn'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="kategori" id="kategori">
                            <?php foreach ($kategori as $k) : ?>
                                <?php if ($k['id'] == $buku['id_kategori']) : ?>
                                    <option value="<?= $k['id'] ?>" selected><?= $k['nama_kategori'] ?></option>
                                <?php else : ?>
                                    <option value="<?= $k['id'] ?>"><?= $k['nama_kategori'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Ubah Buku</button>
            <a href="index.php" class="btn btn-warning">Batal</a>
        </form>

    </div>
    <script src="<?= BASE_URL ?>/js/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>/js/bootstrap.min.js"></script>
</body>

</html>