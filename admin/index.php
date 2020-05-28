<?php
include '../config.php';
include '../koneksi.php';
include '../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:" . BASE_URL . "/login.php");
}

//Ambil data buku dari tabel buku join dengan kategori
$sql = "SELECT buku.id, judul, tahun_terbit, kategori.nama_kategori FROM buku
        JOIN kategori ON id_kategori = kategori.id";
$hasil = mysqli_query($db, $sql);
$buku = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $buku[] = $data;
}

//Ambil data penerbit dari tabel penerbit
$sql = "SELECT id, nama_penerbit FROM penerbit";
$hasil = mysqli_query($db, $sql);
$penerbit = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $penerbit[] = $data;
}

//Ambil data kategori dari tabel kategori
$sql = "SELECT id, nama_kategori FROM kategori";
$hasil = mysqli_query($db, $sql);
$kategori = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $kategori[] = $data;
}

//Tambahkan judul
$title = 'Home';
?>
<?php include 'header.php'; ?>
<div class="container py-3">

    <h3 class="mt-5 mb-3 pt-2 text-center">Form Tambah Buku Baru</h3>

    <form action="tambah-buku.php" method="post">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="judul">Judul Buku</label>
                    <input class="form-control" type="text" name="judul" id="judul" required>
                </div>
                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <select class="form-control" name="penerbit" id="penerbit" required>
                        <option value="">--- Pilih Penerbit ---</option>
                        <?php if ($penerbit != []) : ?>
                            <?php foreach ($penerbit as $p) : ?>
                                <option value="<?= $p['id'] ?>"><?= $p['nama_penerbit'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun Terbit</label>
                    <input class="form-control" type="number" name="tahun" id="tahun" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input class="form-control" type="text" name="penulis" id="penulis" required>
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input class="form-control" type="text" name="isbn" id="isbn" required>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" name="kategori" id="kategori" required>
                        <option value="">--- Pilih Kategori ---</option>
                        <?php if ($kategori != []) : ?>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id'] ?>"><?= $k['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Tambah Buku</button>
        <button class="btn btn-danger" type="reset">Reset</button>
    </form>

    <hr>

    <h3>List Buku</h3>

    <table id="tbl-daftar-buku" class="table dt-responsive nowrap" style="width: 100%;">
        <thead class="thead-dark text-center">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Tahun Terbit</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($buku != []) : ?>
                <?php $i = 1; ?>
                <?php foreach ($buku as $b) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $b['judul'] ?></td>
                        <td><?= $b['tahun_terbit'] ?></td>
                        <td><?= $b['nama_kategori'] ?></td>
                        <td class="text-center">
                            <a class="badge badge-info" href="detail-buku.php?id=<?= $b['id'] ?>">Detail ></a>
                            <a class="badge badge-warning" href="ubah-buku.php?id=<?= $b['id'] ?>">Ubah</a>
                            <a class="badge badge-danger" href="hapus-buku.php?id=<?= $b['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5"><strong>Tidak ada data buku</strong></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?php include 'footer.php'; ?>