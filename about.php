<?php
include 'config.php';
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Pintar Ilmu - About</title>
    <link rel="icon" href="<?= BASE_URL ?>/img/favicon.png" type="image/png">
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
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="
                    <?php if (isset($_SESSION['role'])) : ?>
                        <?php if ($_SESSION['role'] == 1) : ?>
                            <?= BASE_URL ?>/admin
                        <?php else : ?>
                            <?= BASE_URL ?>/member
                        <?php endif; ?>
                    <?php endif; ?>
                    ">Kembali</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-3">

        <h3 class="mt-5 mb-3 pt-2 text-center">Tentang web ini</h3>
        <p>
            Selamat datang di aplikasi web Perpustakaan Pintar Ilmu. Web ini mengusung tema perpustakaan, oleh karena itu nama web ini adalah Perpustakaan Pintar Ilmu. Web ini dibuat untuk menyelesaikan project ujian tengah semester mata kuliah Pemrograman Web di ITB Stikom Bali. Web ini adalah web CRUD (Create Read Update Delete) yang sederhana. Web ini dapat melihat, menambahkan, mengubah, dan menghapus buku. Terdapat menu tambahan yaitu kategori dan penerbit untuk menambahkan, mengubah, dan menghapus penerbit atau kategori untuk buku. Web ini dibuat menggunakan php dan framework bootstrap. Semoga web ini dapat bermanfaat bagi yang mengaksesnya. Mohon maaf bila masih banyak kekurangan pada website ini, akhir kata saya ucapkan terima kasih.
        </p>
        <p>
            Made with &#10084; by Putu Andika Tedja Permana<br>
            NIM : 180030302 <br>
            Kelas : BI183
        </p>

    </div>
    <script src="<?= BASE_URL ?>/js/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>/js/bootstrap.min.js"></script>
</body>

</html>