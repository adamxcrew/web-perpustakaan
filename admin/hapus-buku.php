<?php
include '../koneksi.php';
include '../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:login.php");
}

//Cek apakah user tidak sengaja membuka hapus buku php tanpa mengirimkan data
//Jika tidak ada data yang dikirimkan maka kembalikan ke halaman utama
if (isset($_GET['id'])) {

    //Ambil id buku yang ingin dihapus dari url
    $id = $_GET['id'];

    //Cek apakah id buku ada dalam database
    $cari = mysqli_query($db, "SELECT id FROM buku WHERE id = '$id'");
    $row = mysqli_num_rows($cari);
    //Jika row berisikan nilai 0 maka tidak ada buku yang ingin dihapus dalam database
    //Kembalikan ke halaman utama
    if ($row == 0) {
        echo "<script>
                alert('Buku yang ingin dihapus tidak ada dalam database, silahkan cek id buku');
                document.location.href = 'index.php';
            </script>";
        die;
    }

    $sql = "DELETE FROM buku WHERE id = '$id'";

    $hapus = mysqli_query($db, $sql);

    if (!$hapus) {
        echo mysqli_error($db);
        die;
    }
    echo "<script>
            alert('Buku berhasil dihapus');
            document.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Silahkan menghapus buku dari halaman utama');
            document.location.href = 'index.php';
          </script>";
}
