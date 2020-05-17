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
                    <td><a href="#" class="badge badge-info btn-detail-buku" data-toggle="modal" data-target="#detailBuku" data-id="<?= $b['id'] ?>">Detail</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="detailBuku" tabindex="-1" role="dialog" aria-labelledby="detailBukuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailBukuLabel">Detail Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 id="judul-buku"></h5>
                <p id="tahun-terbit"></p>
                <p id="penulis"></p>
                <p id="isbn"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>