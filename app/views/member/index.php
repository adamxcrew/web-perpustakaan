<h3>Dashboard Member</h3>
<hr>

<div class="card shadow">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-lg-12">
                <h5 class="mb-0">Selamat datang, <?= $data['nama'] ?>!</h5>
                <small class="m-0">ID Member: <?= $data['id_member'] ?></small>
                <p class="mt-3">Mau cari buku apa hari ini? yuk lihat beberapa koleksi buku terbaru kami!</p>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($data['buku'] as $b) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $b['judul'] ?></td>
                                <td><?= $b['tahun_terbit'] ?></td>
                                <td><?= $b['nama_kategori'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <hr>
                <h5 class="mt-3">Daftar pinjaman terakhir</h5>
                <p>Jangan lupa untuk mengembalikan buku pinjaman ya!</p>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pinjam</th>
                            <th>Lama Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($data['pinjaman'] as $p) : ?>
                            <?php
                            $tgl_skrg = date('Y-m-d');
                            $datediff = strtotime($tgl_skrg) - strtotime($p['tanggal_pinjam']);
                            $bedahari = abs(round($datediff / (60 * 60 * 24)));

                            if ($bedahari > $p['lama_pinjam'] && $p['tanggal_kembali'] == NULL) : ?>
                                <tr class="bg-warning">
                                    <td><?= $i++ ?></td>
                                    <td><?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?></td>
                                    <td><?= $p['lama_pinjam'] ?> Hari</td>
                                    <?php if ($p['tanggal_kembali'] == NULL) : ?>
                                        <td class="text-danger">Belum Dikembalikan</td>
                                    <?php else : ?>
                                        <td class="text-success">Sudah Dikembalikan</td>
                                    <?php endif ?>
                                </tr>
                            <?php else : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?></td>
                                    <td><?= $p['lama_pinjam'] ?> Hari</td>
                                    <?php if ($p['tanggal_kembali'] == NULL) : ?>
                                        <td class="text-danger">Belum Dikembalikan</td>
                                    <?php else : ?>
                                        <td class="text-success">Sudah Dikembalikan</td>
                                    <?php endif ?>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>