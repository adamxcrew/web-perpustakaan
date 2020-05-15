<?php
include '../config.php';
$username = $_SESSION['login'];
$result = mysqli_query($db, "SELECT nama FROM users WHERE username = '$username'");
$nama = mysqli_fetch_assoc($result)['nama'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Pintar Ilmu - <?= $title ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">Perpustakaan Pintar Ilmu</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigasiMain" aria-controls="navigasiMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigasiMain">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link <?= ($title == 'Home' ? 'active' : '') ?>" href="<?= BASE_URL ?>/member">Home</a>
                    <a class="nav-item nav-link <?= ($title == 'Daftar Buku' ? 'active' : '') ?>" href="<?= BASE_URL ?>/member/daftar-buku.php">Daftar Buku</a>
                    <a class="nav-item nav-link <?= ($title == 'Daftar Pinjaman' ? 'active' : '') ?>" href="<?= BASE_URL ?>/member/daftar-pinjaman.php">Pinjaman Buku</a>
                    <a class="nav-item nav-link <?= ($title == 'Kontak' ? 'active' : '') ?>" href="<?= BASE_URL ?>/member/kontak.php">Hubungi Kami</a>
                </div>
                <div class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $nama ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= BASE_URL ?>/member/profil.php">Profil</a>
                            <a class="dropdown-item" onclick="return confirm('Apakah anda yakin ingin keluar?')" href="<?= BASE_URL ?>/logout.php">Logout</a>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </nav>