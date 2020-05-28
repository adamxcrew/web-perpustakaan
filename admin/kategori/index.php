<?php
include '../../config.php';
include '../../koneksi.php';
include '../../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:" . BASE_URL . "/login.php");
}

//Ambil data kategori dari tabel kategori
$sql = "SELECT * FROM kategori";
$hasil = mysqli_query($db, $sql);
$kategori = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $kategori[] = $data;
}
$title = 'Kategori';
?>
<?php include '../header.php'; ?>

<div class="container py-3">

    <h3 class="mt-5 mb-3 pt-2 text-center">Form Tambah Kategori Baru</h3>

    <form action="tambah.php" method="post">
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input class="form-control" type="text" name="keterangan" id="keterangan" required>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Tambah Kategori</button>
        <button class="btn btn-danger" type="reset">Reset</button>
    </form>

    <hr>

    <h3>List Kategori</h3>

    <table id="tbl-list-kategori" class="table dt-responsive nowrap" style="width: 100%;">
        <thead class="thead-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($kategori != [[]]) : ?>
                <?php $i = 1; ?>
                <?php foreach ($kategori as $k) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $k['nama_kategori'] ?></td>
                        <td><?= $k['keterangan'] ?></td>
                        <td class="text-center">
                            <a class="badge badge-warning" href="ubah.php?id=<?= $k['id'] ?>">Ubah</a>
                            <a class="badge badge-danger" href="hapus.php?id=<?= $k['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?php include '../footer.php'; ?>