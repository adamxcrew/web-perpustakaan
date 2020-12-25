<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base_url" content="<?= BASEURL ?>">
    <title>Perpustakaan Pintar Ilmu - <?= $data['title'] ?></title>
    <link rel="icon" href="<?= BASEURL ?>/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.17/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.bootstrap4.min.css">
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
                    <a class="nav-item nav-link <?= ($data['title'] == 'Home' ? 'active' : '') ?>" href="<?= BASEURL ?>/admin">Home</a>
                    <a class="nav-item nav-link <?= ($data['title'] == 'Buku' ? 'active' : '') ?>" href="<?= BASEURL ?>/admin/daftar-buku">Daftar Buku</a>
                    <a class="nav-item nav-link <?= ($data['title'] == 'Input Peminjaman' ? 'active' : '') ?>" href="<?= BASEURL ?>/admin/input-peminjaman">Input Peminjaman</a>
                    <a class="nav-item nav-link <?= ($data['title'] == 'Daftar Pinjaman' ? 'active' : '') ?>" href="<?= BASEURL ?>/admin/daftar-pinjaman">Daftar Pinjaman</a>
                    <a class="nav-item nav-link <?= ($data['title'] == 'Penerbit' ? 'active' : '') ?>" href="<?= BASEURL ?>/admin/penerbit">Penerbit</a>
                    <a class="nav-item nav-link <?= ($data['title'] == 'Kategori' ? 'active' : '') ?>" href="<?= BASEURL ?>/admin/kategori">Kategori</a>
                    <a class="nav-item nav-link <?= ($data['title'] == 'About' ? 'active' : '') ?>" href="<?= BASEURL ?>/admin/about">About</a>
                </div>
                <div class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hello <?= $data['nama'] ?>!
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" onclick="return confirm('Apakah anda yakin ingin keluar?')" href="<?= BASEURL ?>/admin/logout">Logout</a>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </nav>