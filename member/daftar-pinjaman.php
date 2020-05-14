<?php
session_start();
include '../functions.php';

//Cek apakah sudah login dan member
if (!isLogin() || !isMember()) {
    header('Location:../login.php');
}

$title = 'Daftar Pinjaman';
?>
<?php include 'header.php' ?>
<div class="container py-3">
    <h3 class="mt-5 pt-2">Daftar Pinjaman Buku</h3>
    <hr>
    <p>Daftar pinjaman kamu, jangan lupa dikembalikan ya supaya tidak terkena denda!</p>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Nama Buku</th>
                <th>Lama Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>24 May 2020</td>
                <td>Si Kancil</td>
                <td>1 Minggu</td>
                <td>Belum Dikembalikan</td>
            </tr>
        </tbody>
    </table>
</div>
<?php include 'footer.php' ?>