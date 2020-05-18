<?php
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.17/dist/css/bootstrap-select.min.css">
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
                    <a class="nav-item nav-link <?= ($title == 'Home' ? 'active' : '') ?>" href="<?= BASE_URL ?>/admin">Home</a>
                    <a class="nav-item nav-link <?= ($title == 'Input Peminjaman' ? 'active' : '') ?>" href="<?= BASE_URL ?>/admin/input-peminjaman.php">Input Peminjaman</a>
                    <a class="nav-item nav-link <?= ($title == 'Penerbit' ? 'active' : '') ?>" href="<?= BASE_URL ?>/admin/penerbit">Penerbit</a>
                    <a class="nav-item nav-link <?= ($title == 'Kategori' ? 'active' : '') ?>" href="<?= BASE_URL ?>/admin/kategori">Kategori</a>
                    <a class="nav-item nav-link <?= ($title == 'About' ? 'active' : '') ?>" href="<?= BASE_URL ?>/about.php">About</a>
                </div>
                <div class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hello <?= $nama ?>!
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" onclick="return confirm('Apakah anda yakin ingin keluar?')" href="<?= BASE_URL ?>/logout.php">Logout</a>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </nav>