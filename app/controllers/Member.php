<?php

class Member extends Controller {

    private $peminjamanModel;
    private $bukuModel;
    private $userModel;

    function __construct()
    {
        if (isset($_SESSION['user']['role'])) {
            if ($_SESSION['user']['role'] != 2) {
                header('Location: ' . BASEURL . '/login');
            }
        } else {
            header('Location: ' . BASEURL . '/login');
        }

        $this->peminjamanModel = $this->model('Peminjaman_model');
        $this->bukuModel = $this->model('Buku_model');
        $this->userModel = $this->model('User_model');
    }

    public function index() {
        $data['title'] = 'Home';
        $data['id_member']= $_SESSION['user']['id'];
        $data['nama'] = $_SESSION['user']['nama'];
        $data['pinjaman'] = $this->peminjamanModel->getPinjamanMember($_SESSION['user']['id']);
        $data['buku'] = $this->bukuModel->getAllBuku();

        $this->view('member/header', $data);
        $this->view('member/index', $data);
        $this->view('member/footer');
    }

    public function daftar_buku() {
        $data['title'] = 'Daftar Buku';
        $data['nama'] = $_SESSION['user']['nama'];
        $data['buku'] = $this->bukuModel->getAllBuku();

        $this->view('member/header', $data);
        $this->view('member/daftar-buku', $data);
        $this->view('member/footer');
    }

    public function ambil_buku() {
        echo json_encode($this->bukuModel->getDetailBuku($_POST['id']));
    }

    public function daftar_pinjaman() {
        $data['title'] = 'Daftar Pinjaman';
        $data['nama'] = $_SESSION['user']['nama'];
        $data['pinjaman'] = $this->peminjamanModel->getPinjamanMember($_SESSION['user']['id']);

        $this->view('member/header', $data);
        $this->view('member/daftar-pinjaman', $data);
        $this->view('member/footer');
    }

    public function ambil_pinjaman() {
        $id_pinjaman = $_POST['id'];

        $buku = $this->peminjamanModel->getPinjamanBuku($id_pinjaman);
        $pinjaman = $this->peminjamanModel->getDetailPinjaman($id_pinjaman);

        echo json_encode([$buku, $pinjaman]);
    }

    public function kontak() {
        $data['title'] = 'Kontak';
        $data['nama'] = $_SESSION['user']['nama'];

        $this->view('member/header', $data);
        $this->view('member/kontak');
        $this->view('member/footer');
    }

    public function about() {
        $data['title'] = 'About';
        $data['nama'] = $_SESSION['user']['nama'];

        $this->view('member/header', $data);
        $this->view('about/index');
        $this->view('member/footer');
    }

    public function profil() {
        $data['title'] = 'Profil';
        $data['nama'] = $_SESSION['user']['nama'];
        $data['id_member']= $_SESSION['user']['id'];
        $data['username']= $_SESSION['user']['username'];

        $this->view('member/header', $data);
        $this->view('member/profil', $data);
        $this->view('member/footer');
    }

    public function edit_profil() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/member/profil');
        }

        $data = $this->userModel->updateUser($_SESSION['user']['id'], $_SESSION['user']['username'], $_POST);
        if ($data == 0) {
            Flasher::setFlash('Username sudah digunakan', 'danger');
            header('Location: ' . BASEURL . '/member/profil');
        } else {
            $_SESSION['user']['username'] = $data['new_username'];
            $_SESSION['user']['nama'] = $data['new_nama'];
            Flasher::setFlash('Profil berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/member/profil');
        }
    }

    public function edit_password() {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $new_password_confirmation = $_POST['new_password_confirmation'];

        $data = $this->userModel->getUserByID($_SESSION['user']['id']);

        //Cek apakah konfirmasi password sama
        if ($new_password != $new_password_confirmation) {
            Flasher::setFlash('Konfirmasi password tidak sama.', 'danger');
            header('Location: ' . BASEURL . '/member/profil');
        } else {
            if (!password_verify($current_password, $data['password'])) {
                Flasher::setFlash('Password lama salah.', 'danger');
                header('Location: ' . BASEURL . '/member/profil');
            } else {
                $this->userModel->updatePassword($_SESSION['user']['id'], $new_password);
                Flasher::setFlash('Password berhasil diubah', 'success');
                header('Location: ' . BASEURL . '/member/profil');
            }
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL . '/login');
    }
}