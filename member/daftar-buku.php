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
        ORDER BY tgl_input DESC";
$hasil = mysqli_query($db, $sql);
$buku = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $buku[] = $data;
}

$title = 'Daftar Buku';
?>
<?php include 'header.php' ?>
<div class="container py-3">
    <h3 class="mt-5 pt-2">Daftar Buku Perpustakaan</h3>
    <hr>
    <p>Cari dulu disini, kalau ada langsung cus ke perpustakaan!</p>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Nama Buku</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($buku as $b) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $b['judul'] ?></td>
                    <td><?= $b['nama_kategori'] ?></td>
                    <td><a href="#" class="badge badge-info btn-detail-buku">Detail</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php' ?>