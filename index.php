<?php
include 'koneksi.php';
//Ambil data buku dari tabel buku join dengan kategori
$sql = "SELECT judul, tahun_terbit, kategori.nama_kategori FROM buku
        JOIN kategori ON id_kategori = kategori.id";
$hasil = mysqli_query($db, $sql);
$buku = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $buku[] = $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Perpustakaan pintar ilmu" />
    <meta name="author" content="Andika Tedja" />

    <title>Perpustakaan Pintar Ilmu - Landing</title>
    <link rel="icon" href="img/favicon.png" type="image/png">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/custom-style.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="">Perpustakaan Pintar Ilmu</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#buku" class="nav-link js-scroll-trigger">Koleksi Buku</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Register / Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="masthead text-center text-white d-flex">
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h2>
                        Selamat datang di Perpustakaan Pintar Ilmu!
                    </h2>
                    <hr />
                </div>
                <div class="col-lg-8 mx-auto">
                    <p class="text-white mb-5">
                        Perpustakaan yang punya bacaan buku lengkap dan kekinian! Yuk kunjungi perpustakaan kami!
                    </p>
                </div>
            </div>
        </div>
    </header>

    <section id="buku" class="bg-light text-center">
        <div class="container">
            <h4>Koleksi Buku</h4>
            <hr>
            <p>Berikut ini koleksi buku dari Perpustakaan Pintar Ilmu.</p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>Tahun Terbit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($buku as $b) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $b['judul'] ?></td>
                            <td><?= $b['nama_kategori'] ?></td>
                            <td><?= $b['tahun_terbit'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/creative.min.js"></script>
</body>

</html>