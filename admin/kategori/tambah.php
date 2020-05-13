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

    $nama_kategori = htmlspecialchars($_POST['nama_kategori']);
    $keterangan = htmlspecialchars($_POST['keterangan']);

    $sql = "INSERT INTO kategori VALUES
    (null, '$nama_kategori', '$keterangan')";

    $simpan = mysqli_query($db, $sql);
    if (!$simpan) {
        echo mysqli_error($db);
        die;
    }
    echo "<script>
            alert('Kategori baru berhasil ditambahkan');
            document.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Silahkan menambahkan kategori melalui form di halaman utama');
            document.location.href = 'index.php';
          </script>";
}
