<?php
session_start();
include '../koneksi.php';

$operasi = $_GET['op'];

switch ($operasi) {
    case 'tambah':
        $id_member = $_POST['idmember'];
        $id_buku = $_POST['buku'];
        $sql = "SELECT pinjaman.id_pinjaman FROM pinjaman
                JOIN detail_pinjaman ON pinjaman.id_pinjaman = detail_pinjaman.id_pinjaman
                WHERE id_member = $id_member AND id_buku = $id_buku AND tanggal_kembali IS NULL";
        $sudahPinjamBelumKembali = mysqli_num_rows(mysqli_query($db, $sql));
        if ($sudahPinjamBelumKembali > 0) {
            echo json_encode('x');
            break;
        }
        $sql = "SELECT judul FROM buku WHERE id = '$id_buku'";
        $judul = mysqli_fetch_assoc(mysqli_query($db, $sql))['judul'];
        $row_id = md5(serialize($id_buku));
        $data = [
            $row_id => [
                'id_buku' => $id_buku,
                'judul' => $judul,
                'row_id' => $row_id
            ]
        ];

        if (!isset($_SESSION['member_pinjam']) && !isset($_SESSION['pinjaman'])) {
            $_SESSION['member_pinjam'] = [
                'id_member' => $id_member,
                'lama_pinjam' => $_POST['waktu']
            ];
            $_SESSION['pinjaman'] = $data;
            echo json_encode($_SESSION['pinjaman']);
        } else {
            $exist = false;
            foreach ($_SESSION['pinjaman'] as $buku) {
                if ($buku['id_buku'] == $id_buku) {
                    $exist = true;
                    break;
                }
            }
            if ($exist != false) {
                echo json_encode('exist');
            } else {
                $_SESSION['pinjaman'] = array_merge_recursive($_SESSION['pinjaman'], $data);
                echo json_encode($_SESSION['pinjaman']);
            }
        }
        // var_dump($_SESSION['member_pinjam']);
        // var_dump($_SESSION['pinjaman']);
        break;

    case 'hapus':
        $row_id = $_GET['row_id'];
        // $newPinjaman = $_SESSION['pinjaman'];
        // unset($newPinjaman[$row_id]);
        unset($_SESSION['pinjaman'][$row_id]);
        // $_SESSION['pinjaman'] = $newPinjaman;

        if ($_SESSION['pinjaman'] == []) {
            unset($_SESSION['member_pinjam']);
            unset($_SESSION['pinjaman']);
            header('Location:input-peminjaman.php');
        }
        header('Location:input-peminjaman.php');
        die;
        break;

    case 'simpan':
        if (!isset($_SESSION['pinjaman']) && !isset($_SESSION['member_pinjam'])) {
            echo json_encode('no_session');
            die;
        }
        //Ambil session
        $pinjaman = $_SESSION['pinjaman'];
        $id_member = $_SESSION['member_pinjam']['id_member'];
        $lama_pinjam = $_SESSION['member_pinjam']['lama_pinjam'];
        $tanggal_pinjam = date('Y-m-d');

        //Insert get id
        $sql = "INSERT INTO pinjaman VALUES
                (null, '$id_member', '$tanggal_pinjam', '$lama_pinjam', null, null)";
        mysqli_query($db, $sql);
        $id_peminjaman = mysqli_insert_id($db);
        foreach ($pinjaman as $buku) {
            $sql = "INSERT INTO detail_pinjaman VALUES
                    ('$id_peminjaman', '$buku[id_buku]')";
            mysqli_query($db, $sql);
        }

        unset($_SESSION['pinjaman']);
        unset($_SESSION['member_pinjam']);
        echo json_encode('OK');
        break;

    case 'cekmember':
        $id_member = $_POST['idmember'];
        $result = mysqli_query($db, "SELECT nama FROM users WHERE id = '$id_member' AND role != '1'");
        $adamember = mysqli_num_rows($result);
        if ($adamember == 0) {
            echo json_encode('tidak ditemukan');
        } else {
            echo json_encode(mysqli_fetch_assoc($result));
        }
        break;

    case 'clear':
        unset($_SESSION['member_pinjam']);
        unset($_SESSION['pinjaman']);
        break;

    case 'dump':
        var_dump($_SESSION['pinjaman']);
        break;

    default:
        header('Location:input-peminjaman.php');
        break;
}
