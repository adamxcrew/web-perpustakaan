<div class="container py-3">
    <h3 class="mt-5 mb-3 pt-2">Detail Buku</h3>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= $data['buku']['judul'] ?></h4>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $data['buku']['tahun_terbit'] ?></h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Penulis:</b> <?= $data['buku']['penulis'] ?></li>
                    <li class="list-group-item"><b>Penerbit:</b> <?= $data['buku']['nama_penerbit'] ?></li>
                    <li class="list-group-item"><b>Kategori:</b> <?= $data['buku']['nama_kategori'] ?></li>
                    <li class="list-group-item"><b>ISBN:</b> <?= $data['buku']['isbn'] ?></li>
                </ul>
                <div class="card-body">
                    <a href="<?= BASEURL ?>/admin/daftar-buku" class="card-link">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>