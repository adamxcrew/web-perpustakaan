<?php
session_start();
include '../koneksi.php';
include '../functions.php';
//Cek apakah sudah login dan member
if (!isLogin() || !isMember()) {
        header('Location:../login.php');
}

$id = $_POST['id'];
$sql = "SELECT buku.*, kategori.nama_kategori, penerbit.nama_penerbit FROM buku
        JOIN kategori ON buku.id_kategori = kategori.id
        JOIN penerbit ON buku.id_penerbit = penerbit.id
        WHERE buku.id = '$id'";
$buku = mysqli_fetch_assoc(mysqli_query($db, $sql));
echo json_encode($buku);
