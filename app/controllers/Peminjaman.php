<?php

class Peminjaman extends Controller
{

    private $peminjamanModel;
    private $userModel;
    private $bukuModel;

    function __construct()
    {
        if (SessionManager::checkSession()) {
            $payload = SessionManager::getCurrentSession();
            if ($payload->role != 1) {
                header('Location: ' . BASEURL . '/login');
            }
        } else {
            header('Location: ' . BASEURL . '/login');
        }
        $this->peminjamanModel = $this->model('Peminjaman_model');
        $this->userModel = $this->model('User_model');
        $this->bukuModel = $this->model('Buku_model');
    }

    public function index()
    {
        header('Location: ' . BASEURL . '/admin');
    }

    public function tambah()
    {
        $id_member = $_POST['idmember'];
        $id_buku = $_POST['buku'];

        $sudahPinjamBelumKembali = $this->peminjamanModel->pinjamBelumKembali($_POST);
        if ($sudahPinjamBelumKembali > 0) {
            echo json_encode('x');
            die;
        }

        //Cek member
        $memberExist = $this->userModel->checkUserByID($id_member);
        if ($memberExist == 0) {
            echo json_encode('xmember');
            die;
        }

        $judul = $this->bukuModel->getDetailBuku($id_buku)['judul'];
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
    }

    public function hapus($row_id)
    {
        // $newPinjaman = $_SESSION['pinjaman'];
        // unset($newPinjaman[$row_id]);
        unset($_SESSION['pinjaman'][$row_id]);
        // $_SESSION['pinjaman'] = $newPinjaman;

        if ($_SESSION['pinjaman'] == []) {
            unset($_SESSION['member_pinjam']);
            unset($_SESSION['pinjaman']);
            header('Location: ' . BASEURL . '/admin/input-peminjaman');
        }
        header('Location: ' . BASEURL . '/admin/input-peminjaman');
    }

    public function cekmember()
    {
        $adamember = $this->userModel->checkUserByID($_POST['idmember']);
        if ($adamember == 0) {
            echo json_encode('tidak ditemukan');
        } else {
            echo json_encode($this->userModel->getUserByID($_POST['idmember']));
        }
    }

    public function ceksesi()
    {
        if (!isset($_SESSION['pinjaman']) && !isset($_SESSION['member_pinjam'])) {
            echo json_encode('no_session');
        }
    }

    public function simpan()
    {
        if (!isset($_SESSION['pinjaman']) && !isset($_SESSION['member_pinjam'])) {
            echo json_encode('no_session');
            die;
        }

        //Ambil session
        $pinjaman = $_SESSION['pinjaman'];
        $id_member = $_SESSION['member_pinjam']['id_member'];
        $lama_pinjam = $_SESSION['member_pinjam']['lama_pinjam'];

        $this->peminjamanModel->simpanPinjaman($pinjaman, $id_member, $lama_pinjam);

        unset($_SESSION['pinjaman']);
        unset($_SESSION['member_pinjam']);
        echo json_encode('OK');
    }

    public function detail()
    {
        $id_pinjaman = $_POST['id'];

        $buku = $this->peminjamanModel->getPinjamanBuku($id_pinjaman);
        $pinjaman = $this->peminjamanModel->getDetailPinjaman($id_pinjaman);

        echo json_encode([$buku, $pinjaman]);
    }

    public function selesai()
    {
        $id_pinjaman = $_POST['id'];
        $waktu = $this->peminjamanModel->getWaktuPinjaman($id_pinjaman);
        $lama_pinjam = $waktu['lama_pinjam'];
        $tanggal_pinjam = $waktu['tanggal_pinjam'];
        $tanggal_kembali = date('Y-m-d');

        $datediff = strtotime($tanggal_kembali) - strtotime($tanggal_pinjam);
        $bedahari = abs(round($datediff / (60 * 60 * 24)));

        if ($bedahari > $lama_pinjam) {
            $denda = ($bedahari - $lama_pinjam) * 10000;
            $this->peminjamanModel->updatePinjaman($id_pinjaman, $tanggal_kembali, $denda);
            echo json_encode($denda);
        } else {
            $this->peminjamanModel->updatePinjaman($id_pinjaman, $tanggal_kembali, 0);
            echo json_encode('tidak denda');
        }
    }
}
