<?php
session_start();
include '../koneksi.php';

$operasi = $_GET['op'];

switch ($operasi) {
    case 'tambah':
        $id_member = $_POST['idmember'];
        $id_buku = $_POST['buku'];
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
            $_SESSION['member_pinjam'] = $id_member;
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
