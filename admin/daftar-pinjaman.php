<?php
include '../config.php';
include '../koneksi.php';
include '../functions.php';

//Cek apakah user sudah login
session_start();

if (!isLogin() || !isAdmin()) {
    header("Location:" . BASE_URL . "/login.php");
}

//Ambil pinjaman dari db
$sql = "SELECT id_pinjaman, nama, tanggal_pinjam, tanggal_kembali, lama_pinjam FROM pinjaman 
        JOIN users ON pinjaman.id_member = users.id
        ORDER BY tanggal_pinjam DESC";
$hasil = mysqli_query($db, $sql);
$pinjaman = [];
while ($data = mysqli_fetch_assoc($hasil)) {
    $pinjaman[] = $data;
}

//Tambahkan judul
$title = 'Daftar Pinjaman';
?>
<?php include 'header.php'; ?>
<div class="container py-3">

    <h3 class="mt-5 mb-3 pt-2 text-center">Daftar Pinjaman</h3>

    <table id="daftar-pinjaman" class="table mt-3 dt-responsive nowrap" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Nama Member</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($pinjaman as $p) : ?>
                <?php
                $tgl_skrg = date('Y-m-d');
                $datediff = strtotime($tgl_skrg) - strtotime($p['tanggal_pinjam']);
                $bedahari = abs(round($datediff / (60 * 60 * 24)));

                if ($bedahari > $p['lama_pinjam'] && $p['tanggal_kembali'] == NULL) : ?>
                    <tr class="bg-warning">
                        <td><?= $i++ ?></td>
                        <td><?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?></td>
                        <td><?= $p['nama'] ?></td>
                        <?php if ($p['tanggal_kembali'] == NULL) : ?>
                            <td class="text-danger">Belum Dikembalikan</td>
                        <?php else : ?>
                            <td class="text-success">Sudah Dikembalikan</td>
                        <?php endif ?>
                        <td>
                            <a href="#" class="badge badge-info btn-detail-pinjaman" <?php echo $p['tanggal_kembali'] == NULL ? 'data-kembali="false"' : 'data-kembali="true"' ?> data-id="<?= $p['id_pinjaman'] ?>" data-toggle="modal" data-target="#detailPinjamanModal">Detail</a>
                        </td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?></td>
                        <td><?= $p['nama'] ?></td>
                        <?php if ($p['tanggal_kembali'] == NULL) : ?>
                            <td class="text-danger">Belum Dikembalikan</td>
                        <?php else : ?>
                            <td class="text-success">Sudah Dikembalikan</td>
                        <?php endif ?>
                        <td>
                            <a href="#" class="badge badge-info btn-detail-pinjaman" <?php echo $p['tanggal_kembali'] == NULL ? 'data-kembali="false"' : 'data-kembali="true"' ?> data-id="<?= $p['id_pinjaman'] ?>" data-toggle="modal" data-target="#detailPinjamanModal">Detail</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<!-- Modal -->
<div class="modal fade" id="detailPinjamanModal" tabindex="-1" role="dialog" aria-labelledby="detailPinjamanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPinjamanModalLabel">Detail Pinjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>ID Pinjaman : <span id="id-pinjaman"></span></h5>
                <p id="nama-member"></p>
                <p id="lama-pinjam"></p>
                <ol id="daftar-buku">

                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="selesaikan-pinjaman" type="button" class="btn btn-success" data-id="">Selesaikan Pinjaman</button>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>