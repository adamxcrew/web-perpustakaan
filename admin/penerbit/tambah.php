<?php
include '../../koneksi.php';
include '../../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:../../login.php");
}

//Cek apakah user tidak sengaja membuka tambah php tanpa mengirimkan data
//Jika tidak ada data yang dikirimkan maka kembalikan ke halaman utama
if (isset($_POST['submit'])) {

    $nama_penerbit = htmlspecialchars($_POST['nama_penerbit']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telp = htmlspecialchars($_POST['no_telp']);

    $sql = "INSERT INTO penerbit VALUES
    (null, '$nama_penerbit', '$alamat', '$no_telp')";

    $simpan = mysqli_query($db, $sql);
    if (!$simpan) {
        echo mysqli_error($db);
        die;
    }
    echo "<script>
            alert('Penerbit baru berhasil ditambahkan');
            document.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Silahkan menambahkan penerbit melalui form di halaman penerbit');
            document.location.href = 'index.php';
          </script>";
}
