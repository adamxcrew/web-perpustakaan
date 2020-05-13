<?php
include '../../koneksi.php';
include '../../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:../../login.php");
}

//Cek apakah user tidak sengaja membuka hapus php tanpa mengirimkan data
//Jika tidak ada data yang dikirimkan maka kembalikan ke halaman utama
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    //Cek apakah id kategori ada dalam database
    $cari = mysqli_query($db, "SELECT id FROM kategori WHERE id = '$id'");
    $row = mysqli_num_rows($cari);
    //Jika row berisikan nilai 0 maka tidak ada kategori yang ingin dihapus dalam database
    //Kembalikan ke halaman utama
    if ($row == 0) {
        echo "<script>
                alert('Kategori yang ingin dihapus tidak ada dalam database, silahkan cek id kategori');
                document.location.href = 'index.php';
            </script>";
        die;
    }

    $sql = "DELETE FROM kategori WHERE id = '$id'";

    $hapus = mysqli_query($db, $sql);
    if (!$hapus) {
        echo mysqli_error($db);
        die;
    }
    echo "<script>
            alert('Kategori berhasil dihapus');
            document.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Silahkan menghapus kategori dari halaman kategori');
            document.location.href = 'index.php';
          </script>";
}
