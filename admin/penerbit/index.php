<?php
include '../../config.php';
include '../../koneksi.php';
include '../../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:" . BASE_URL . "/login.php");
}

//Ambil data penerbit dari tabel penerbit
$sql = "SELECT * FROM penerbit";
$hasil = mysqli_query($db, $sql);
$penerbit = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $penerbit[] = $data;
}
$title = 'Penerbit';
?>
<?php include '../header.php'; ?>

<div class="container py-3">

    <h3 class="mt-5 mb-3 pt-2 text-center">Form Tambah Penerbit Baru</h3>

    <form action="tambah.php" method="post">
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group">
                    <label for="nama_penerbit">Nama Penerbit</label>
                    <input class="form-control" type="text" name="nama_penerbit" id="nama_penerbit" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input class="form-control" type="text" name="alamat" id="alamat" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input class="form-control" type="number" name="no_telp" id="no_telp" required>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Tambah Penerbit</button>
        <button class="btn btn-danger" type="reset">Reset</button>
    </form>

    <hr>

    <h3>List Penerbit</h3>

    <table class="table">
        <thead class="thead-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama Penerbit</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($penerbit != []) : ?>
                <?php $i = 1; ?>
                <?php foreach ($penerbit as $p) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $p['nama_penerbit'] ?></td>
                        <td><?= $p['alamat'] ?></td>
                        <td><?= $p['no_telp'] ?></td>
                        <td class="text-center">
                            <a class="badge badge-warning" href="ubah.php?id=<?= $p['id'] ?>">Ubah</a>
                            <a class="badge badge-danger" href="hapus.php?id=<?= $p['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?php include '../footer.php'; ?>