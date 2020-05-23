<?php
session_start();
include '../koneksi.php';
include '../functions.php';

//Cek apakah sudah login dan member
if (!isLogin() || !isMember()) {
    header('Location:../login.php');
}

//Ambil id member
$username = $_SESSION['login'];
$sql = "SELECT id FROM users WHERE username ='$username'";
$id_member = mysqli_fetch_assoc(mysqli_query($db, $sql))['id'];

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

//Ambil pinjaman dari db
$username = $_SESSION['login'];
$sql = "SELECT id FROM users WHERE username ='$username'";
$id = mysqli_fetch_assoc(mysqli_query($db, $sql))['id'];
$sql = "SELECT tanggal_pinjam, lama_pinjam, tanggal_kembali FROM pinjaman 
        WHERE id_member = '$id'";
$hasil = mysqli_query($db, $sql);
$pinjaman = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $pinjaman[] = $data;
}
$title = 'Home';
?>
<?php include 'header.php' ?>
<div class="container py-3">
    <h3 class="mt-5 pt-2">Dashboard Member</h3>
    <hr>
    <div class="row mt-3">
        <div class="col-lg-12">
            <h5 class="mb-0">Selamat datang, <?= $nama ?>!</h5>
            <small class="m-0">ID Member: <?= $id_member ?></small>
            <p class="mt-3">Mau cari buku apa hari ini? yuk lihat beberapa koleksi buku terbaru kami!</p>
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
                        <th>Lama Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($pinjaman as $p) : ?>
                        <?php
                        $tgl_skrg = date('Y-m-d');
                        $datediff = strtotime($tgl_skrg) - strtotime($p['tanggal_pinjam']);
                        $bedahari = abs(round($datediff / (60 * 60 * 24)));

                        if ($bedahari > $p['lama_pinjam'] && $p['tanggal_kembali'] == NULL) : ?>
                            <tr class="bg-warning">
                                <td><?= $i++ ?></td>
                                <td><?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?></td>
                                <td><?= $p['lama_pinjam'] ?> Hari</td>
                                <?php if ($p['tanggal_kembali'] == NULL) : ?>
                                    <td class="text-danger">Belum Dikembalikan</td>
                                <?php else : ?>
                                    <td class="text-success">Sudah Dikembalikan</td>
                                <?php endif ?>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?></td>
                                <td><?= $p['lama_pinjam'] ?> Hari</td>
                                <?php if ($p['tanggal_kembali'] == NULL) : ?>
                                    <td class="text-danger">Belum Dikembalikan</td>
                                <?php else : ?>
                                    <td class="text-success">Sudah Dikembalikan</td>
                                <?php endif ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>