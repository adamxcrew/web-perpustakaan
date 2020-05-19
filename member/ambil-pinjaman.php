<?php
session_start();
include '../koneksi.php';
include '../functions.php';
//Cek apakah sudah login dan member
if (!isLogin() || !isMember()) {
    header('Location:../login.php');
}

$username = $_SESSION['login'];
$sql = "SELECT id FROM users WHERE username ='$username'";
$id_member = mysqli_fetch_assoc(mysqli_query($db, $sql))['id'];

$id_pinjaman = $_POST['id'];
$sql = "SELECT judul FROM buku 
        JOIN detail_pinjaman ON detail_pinjaman.id_buku = buku.id
        JOIN pinjaman ON pinjaman.id_pinjaman = detail_pinjaman.id_pinjaman
        WHERE pinjaman.id_pinjaman = '$id_pinjaman' AND id_member = '$id_member'";
$hasil = mysqli_query($db, $sql);
$buku = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $buku[] = $data;
}

$sql = "SELECT tanggal_kembali, denda FROM pinjaman
                JOIN users ON pinjaman.id_member = users.id
                WHERE id_pinjaman = '$id_pinjaman' AND id_member = '$id_member'";
$hasil = mysqli_query($db, $sql);
$pinjaman = mysqli_fetch_assoc($hasil);

echo json_encode([$buku, $pinjaman]);
