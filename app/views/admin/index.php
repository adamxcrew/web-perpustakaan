<div class="container py-3">

    <h3 class="mt-5 mb-3 pt-2">Admin Dashboard</h3>
    <hr>
    <div class="row">
        <div class="col-lg-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Jumlah Buku</div>
                <div class="card-body">
                    <h3 class="card-title"><?= $data['jml_buku'] ?></h3>
                    <p class="card-text">Buku</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Jumlah Member</div>
                <div class="card-body">
                    <h3 class="card-title"><?= $data['jml_member'] ?></h3>
                    <p class="card-text">Member</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Peminjaman Belum Kembali</div>
                <div class="card-body">
                    <h3 class="card-title"><?= $data['belum_kembali'] ?></h3>
                    <p class="card-text">Pinjaman</p>
                </div>
            </div>
        </div>
    </div>

</div>