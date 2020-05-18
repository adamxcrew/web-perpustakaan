<?php
include '../config.php';
include '../koneksi.php';
include '../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:" . BASE_URL . "/login.php");
}

//Ambil buku dari database
$sql = "SELECT id, judul FROM buku";
$hasil = mysqli_query($db, $sql);
$buku = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $buku[] = $data;
}

$title = 'Input Peminjaman'
?>
<?php include 'header.php'; ?>
<div class="container py-3">

    <h3 class="my-5 pt-2 text-center">Input Peminjaman</h3>

    <div class="form-group row">
        <label for="id-member" class="col-sm-2 col-form-label">ID Member</label>
        <div class="col-sm-2">
            <input type="number" class="form-control" id="id-member" value="<?php echo isset($_SESSION['member_pinjam']) ?: '' ?>" name="idmember" required <?php echo isset($_SESSION['member_pinjam']) ? 'disabled' : '' ?>>
        </div>
        <div class="col-sm-4">
            <button class="btn btn-primary">Cek Member</button>
        </div>
    </div>

    <div class="form-group row">
        <label for="buku" class="col-sm-2 col-form-label">Buku</label>
        <div class="col-sm-4">
            <select class="form-control selectpicker" id="buku" data-live-search="true" name="buku" required>
                <option value="">--- Pilih buku ---</option>
                <?php foreach ($buku as $b) : ?>
                    <option value="<?= $b['id'] ?>"><?= $b['judul'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="lama-pinjam" class="col-sm-2 col-form-label">Lama Pinjam</label>
        <div class="col-sm-4">
            <select class="form-control selectpicker" id="lama-pinjam" name="waktu" required>
                <option value="">--- Pilih waktu ---</option>
                <option value="3">3 Hari</option>
            </select>
        </div>
    </div>

    <button id="tambah-peminjaman" class="btn btn-primary">Tambah Peminjaman</button>


    <table class="table mt-4">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="tabel-ajax">
            <?php if (isset($_SESSION['pinjaman'])) : ?>
                <?php $i = 1;
                foreach ($_SESSION['pinjaman'] as $key => $value) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $value['judul'] ?></td>
                        <td><a href="peminjaman.php?op=hapus&row_id=<?= $value['row_id'] ?>" class="badge badge-danger">Hapus</a></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>

        </tbody>
    </table>

</div>
<?php include 'footer.php'; ?>