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

$waktu = [
    [
        'waktu' => 3,
        'nama' => '3 Hari'
    ],
    [
        'waktu' => 7,
        'nama' => '7 Hari'
    ],
    [
        'waktu' => 14,
        'nama' => '14 Hari'
    ]
];

$title = 'Input Peminjaman'
?>
<?php include 'header.php'; ?>
<div class="container py-3">

    <h3 class="my-5 pt-2 text-center">Input Peminjaman</h3>

    <div class="form-group row">
        <label for="id-member" class="col-sm-2 col-form-label">ID Member</label>
        <div class="col-sm-2">
            <input type="number" class="form-control" id="id-member" value="<?php echo isset($_SESSION['member_pinjam']) ? $_SESSION['member_pinjam']['id_member'] : '' ?>" name="idmember" required <?php echo isset($_SESSION['member_pinjam']) ? 'disabled' : '' ?>>
        </div>
        <div class="col-sm-4">
            <button id="cek-member" class="btn btn-info" data-toggle="modal" data-target="#cekMemberModal">Cek Member</button>
        </div>
    </div>

    <div class="form-group row">
        <label for="lama-pinjam" class="col-sm-2 col-form-label">Lama Pinjam</label>
        <div class="col-sm-4">
            <select class="form-control selectpicker" id="lama-pinjam" name="waktu" required <?php echo isset($_SESSION['member_pinjam']) ? 'disabled' : '' ?>>
                <option value="">--- Pilih waktu ---</option>
                <?php foreach ($waktu as $w) : ?>
                    <?php if (isset($_SESSION['member_pinjam'])) : ?>
                        <?php if ($w['waktu'] == $_SESSION['member_pinjam']['lama_pinjam']) : ?>
                            <option value="<?= $w['waktu'] ?>" selected><?= $w['nama'] ?></option>
                        <?php else : ?>
                            <option value="<?= $w['waktu'] ?>"><?= $w['nama'] ?></option>
                        <?php endif ?>
                    <?php else : ?>
                        <option value="<?= $w['waktu'] ?>"><?= $w['nama'] ?></option>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
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
    <button id="simpan-pinjaman" class="btn btn-success">Simpan Pinjaman</button>


</div>

<!-- Modal -->
<div class="modal fade" id="cekMemberModal" tabindex="-1" role="dialog" aria-labelledby="cekMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cekMemberModalLabel">Cek Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 id="ada"></h5>
                <p id="nama-member"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>