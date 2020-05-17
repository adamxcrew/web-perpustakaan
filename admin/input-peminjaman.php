<?php
include '../config.php';
include '../koneksi.php';
include '../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:" . BASE_URL . "/login.php");
}

$title = 'Input Peminjaman'
?>
<?php include 'header.php'; ?>
<div class="container py-3">

    <h3 class="my-5 pt-2 text-center">Input Peminjaman</h3>
    <form action="peminjaman.php" method="post">
        <div class="form-group row">
            <label for="id-member" class="col-sm-2 col-form-label">ID Member</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="id-member">
            </div>
            <div class="col-sm-4">
                <button class="btn btn-primary">Cek Member</button>
            </div>
        </div>
        <div class="form-group row">
            <label for="lama-pinjam" class="col-sm-2 col-form-label">Lama Pinjam</label>
            <div class="col-sm-4">
                <select class="form-control" id="lama-pinjam">
                    <option value="3">3 Hari</option>
                    <option value="7">1 Minggu</option>
                    <option value="14">2 Minggu</option>
                </select>
            </div>
        </div>
    </form>

</div>
<?php include 'footer.php'; ?>