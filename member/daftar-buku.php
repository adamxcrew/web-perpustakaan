<?php
session_start();
include '../functions.php';

//Cek apakah sudah login dan member
if (!isLogin() || !isMember()) {
    header('Location:../login.php');
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
            <tr>
                <td>1</td>
                <td>Si Kancil</td>
                <td>Dongeng</td>
                <td><a href="#" class="badge badge-info">Detail</a></td>
            </tr>
        </tbody>
    </table>
</div>
<?php include 'footer.php' ?>