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
                    <a class="nav-item nav-link <?= ($data['title'] == 'Home' ? 'active' : '') ?>" href="<?= BASEURL ?>/member">Home</a>
                    <a class="nav-item nav-link <?= ($data['title'] == 'Daftar Buku' ? 'active' : '') ?>" href="<?= BASEURL ?>/member/daftar-buku">Daftar Buku</a>
                    <a class="nav-item nav-link <?= ($data['title'] == 'Daftar Pinjaman' ? 'active' : '') ?>" href="<?= BASEURL ?>/member/daftar-pinjaman">Pinjaman Buku</a>
                    <a class="nav-item nav-link <?= ($data['title'] == 'Kontak' ? 'active' : '') ?>" href="<?= BASEURL ?>/member/kontak">Hubungi Kami</a>
                    <a class="nav-item nav-link <?= ($data['title'] == 'About' ? 'active' : '') ?>" href="<?= BASEURL ?>/member/about">About</a>
                </div>
                <div class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $data['nama'] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= BASEURL ?>/member/profil">Profil</a>
                            <a class="dropdown-item" onclick="return confirm('Apakah anda yakin ingin keluar?')" href="<?= BASEURL ?>/member/logout">Logout</a>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </nav>