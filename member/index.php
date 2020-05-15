<?php
session_start();
include '../koneksi.php';
include '../functions.php';

//Cek apakah sudah login dan member
if (!isLogin() || !isMember()) {
    header('Location:../login.php');
}

//Ambil data buku dari tabel buku join dengan kategori
$sql = "SELECT buku.id, judul, tahun_terbit, kategori.nama_kategori FROM buku
        JOIN kategori ON id_kategori = kategori.id
        ORDER BY tgl_input DESC
        LIMIT 5";
$hasil = mysqli_query($db, $sql);
$buku = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $buku[] = $data;
}

$title = 'Home';
?>
<?php include 'header.php' ?>
<div class="container py-3">
    <h3 class="mt-5 pt-2">Dashboard Member</h3>
    <hr>
    <div class="row mt-3">
        <div class="col-lg-12">
            <h5>Selamat datang, <?= $nama ?>!</h5>
            <p>Mau cari buku apa hari ini? yuk lihat beberapa koleksi buku terbaru kami!</p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tahun Terbit</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($buku as $b) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $b['judul'] ?></td>
                            <td><?= $b['tahun_terbit'] ?></td>
                            <td><?= $b['nama_kategori'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <hr>
            <h5 class="mt-3">Daftar pinjaman terakhir</h5>
            <p>Jangan lupa untuk mengembalikan buku pinjaman ya!</p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pinjam</th>
                        <th>Nama Buku</th>
                        <th>Lama Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>24 May 2020</td>
                        <td>Si Kancil</td>
                        <td>1 Minggu</td>
                        <td>Belum Dikembalikan</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>