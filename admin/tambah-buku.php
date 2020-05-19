<?php
include '../koneksi.php';
include '../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:login.php");
}

//Cek apakah user tidak sengaja membuka tambah buku php tanpa mengirimkan data
//Jika tidak ada data yang dikirimkan maka kembalikan ke halaman utama
if (isset($_POST['submit'])) {

    //Tambahan proteksi untuk mengantisipasi data input berupa tag html
    $judul = htmlspecialchars($_POST['judul']);
    $penerbit = htmlspecialchars($_POST['penerbit']);
    $tahun = htmlspecialchars($_POST['tahun']);
    $penulis = htmlspecialchars($_POST['penulis']);
    $isbn = htmlspecialchars($_POST['isbn']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $tgl_input = date('Y-m-d');

    $sql = "INSERT INTO buku VALUES
    (null, '$judul', '$penerbit', '$tahun', '$penulis', '$isbn', '$kategori', '$tgl_input')";

    $simpan = mysqli_query($db, $sql);

    //Cek apakah query gagal, jika gagal tampilkan pesan error dan hentikan proses (die)
    if (!$simpan) {
        echo mysqli_error($db);
        die;
    }
    echo "<script>
            alert('Buku baru berhasil ditambahkan');
            document.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Silahkan menambahkan buku melalui form di halaman utama');
            document.location.href = 'index.php';
          </script>";
}
