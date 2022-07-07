<?php

class Admin extends Controller
{
    private $bukuModel;
    private $penerbitModel;
    private $kategoriModel;
    private $peminjamanModel;
    private $userModel;
    private $payload;

    function __construct()
    {
        if (SessionManager::checkSession()) {
            $this->payload = SessionManager::getCurrentSession();
            if ($this->payload->role != 1) {
                header('Location: ' . BASEURL . '/login');
            }
        } else {
            header('Location: ' . BASEURL . '/login');
        }

        $this->bukuModel = $this->model('Buku_model');
        $this->penerbitModel = $this->model('Penerbit_model');
        $this->kategoriModel = $this->model('Kategori_model');
        $this->peminjamanModel = $this->model('Peminjaman_model');
        $this->userModel = $this->model('User_model');
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['nama'] = $this->payload->nama;
        $data['jml_buku'] = $this->bukuModel->countBuku();
        $data['jml_member'] = $this->userModel->countMember();
        $data['belum_kembali'] = $this->peminjamanModel->countBelumKembali();

        $this->view('admin/header', $data);
        $this->view('admin/index', $data);
        $this->view('admin/footer');
    }

    public function daftar_buku()
    {
        $data['title'] = 'Buku';
        $data['nama'] = $this->payload->nama;
        $data['buku'] = $this->bukuModel->getAllBuku();
        $data['penerbit'] = $this->penerbitModel->getAllPenerbit();
        $data['kategori'] = $this->kategoriModel->getAllKategori();

        $this->view('admin/header', $data);
        $this->view('admin/daftar-buku', $data);
        $this->view('admin/footer');
    }

    public function tambah_buku()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/admin/daftar-buku');
        }

        $this->bukuModel->tambahBuku($_POST);
        Flasher::setFlash('Buku berhasil ditambahkan', 'success');
        header('Location: ' . BASEURL . '/admin/daftar-buku');
    }

    public function detail_buku($id = 0)
    {
        if ($id) {
            $data['title'] = 'Buku';
            $data['nama'] = $this->payload->nama;
            $data['buku'] = $this->bukuModel->getDetailBuku($id);
            $this->view('admin/header', $data);
            $this->view('admin/detail-buku', $data);
            $this->view('admin/footer');
        } else {
            echo 'Harap menggunakan tombol yang ada untuk melihat detail buku';
        }
    }

    public function ubah_buku($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->bukuModel->ubahBuku($id, $_POST);
            Flasher::setFlash('Buku berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/admin/daftar-buku');
        }

        if ($id) {
            $data['title'] = 'Buku';
            $data['nama'] = $this->payload->nama;
            $data['buku'] = $this->bukuModel->getDetailBuku($id);
            $data['penerbit'] = $this->penerbitModel->getAllPenerbit();
            $data['kategori'] = $this->kategoriModel->getAllKategori();

            $this->view('admin/header', $data);
            $this->view('admin/ubah-buku', $data);
            $this->view('admin/footer');
        } else {
            header('Location: ' . BASEURL . '/admin/daftar-buku');
        }
    }

    public function hapus_buku($id = 0)
    {
        if ($id) {
            $hapus = $this->bukuModel->hapusBuku($id);
            if ($hapus == 0) {
                Flasher::setFlash('Buku tidak ditemukan', 'danger');
                header('Location: ' . BASEURL . '/admin/daftar-buku');
            } else {
                Flasher::setFlash('Buku berhasil dihapus', 'success');
                header('Location: ' . BASEURL . '/admin/daftar-buku');
            }
        } else {
            header('Location: ' . BASEURL . '/admin/daftar-buku');
        }
    }

    public function input_peminjaman()
    {
        $data['title'] = 'Input Peminjaman';
        $data['nama'] = $this->payload->nama;
        $data['buku'] = $this->bukuModel->getAllBuku();
        $data['waktu'] = [
            [
                'waktu' => 3,
                'nama' => '3 Hari'
            ],
            [
                'waktu' => 7,
                'nama' => '7 Hari'
            ],
            [
                'waktu' => 14,
                'nama' => '14 Hari'
            ]
        ];

        $this->view('admin/header', $data);
        $this->view('admin/input-peminjaman', $data);
        $this->view('admin/footer');
    }

    public function daftar_pinjaman()
    {
        $data['title'] = 'Daftar Pinjaman';
        $data['nama'] = $this->payload->nama;
        $data['pinjaman'] = $this->peminjamanModel->getAllPinjaman();

        $this->view('admin/header', $data);
        $this->view('admin/daftar-pinjaman', $data);
        $this->view('admin/footer');
    }

    public function penerbit()
    {
        $data['title'] = 'Penerbit';
        $data['nama'] = $this->payload->nama;
        $data['penerbit'] = $this->penerbitModel->getAllPenerbit();

        $this->view('admin/header', $data);
        $this->view('admin/penerbit', $data);
        $this->view('admin/footer');
    }

    public function tambah_penerbit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/admin/penerbit');
        }

        $this->penerbitModel->insertPenerbit($_POST);
        Flasher::setFlash('Penerbit berhasil ditambah', 'success');
        header('Location: ' . BASEURL . '/admin/penerbit');
    }

    public function ubah_penerbit($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->penerbitModel->updatePenerbit($id, $_POST);
            Flasher::setFlash('Penerbit berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/admin/penerbit');
        }

        if (!$id) {
            header('Location: ' . BASEURL . '/admin/penerbit');
        }

        $data['title'] = 'Penerbit';
        $data['nama'] = $this->payload->nama;
        $data['penerbit'] = $this->penerbitModel->getPenerbitById($id);
        $this->view('admin/header', $data);
        $this->view('admin/ubah-penerbit', $data);
        $this->view('admin/footer');
    }

    public function hapus_penerbit($id = 0)
    {
        if (!$id) {
            header('Location: ' . BASEURL . '/admin/penerbit');
        }

        $hapus = $this->penerbitModel->hapusPenerbit($id);
        if ($hapus == 0) {
            Flasher::setFlash('Penerbit tidak ditemukan', 'danger');
            header('Location: ' . BASEURL . '/admin/penerbit');
        } else {
            Flasher::setFlash('Penerbit berhasil dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/penerbit');
        }
    }

    public function kategori()
    {
        $data['title'] = 'Kategori';
        $data['nama'] = $this->payload->nama;
        $data['kategori'] = $this->kategoriModel->getAllKategori();
        $this->view('admin/header', $data);
        $this->view('admin/kategori', $data);
        $this->view('admin/footer');
    }

    public function tambah_kategori()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/admin/kategori');
        }

        $this->kategoriModel->tambahKategori($_POST);
        Flasher::setFlash('Kategori baru berhasil ditambah', 'success');
        header('Location: ' . BASEURL . '/admin/kategori');
    }

    public function ubah_kategori($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->kategoriModel->updateKategori($id, $_POST);
            Flasher::setFlash('Kategori berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/admin/kategori');
        }

        if (!$id) {
            header('Location: ' . BASEURL . '/admin/kategori');
        }

        $data['title'] = 'Kategori';
        $data['nama'] = $this->payload->nama;
        $data['kategori'] = $this->kategoriModel->getKategoriById($id);
        $this->view('admin/header', $data);
        $this->view('admin/ubah-kategori', $data);
        $this->view('admin/footer');
    }

    public function hapus_kategori($id)
    {
        if (!$id) {
            header('Location: ' . BASEURL . '/admin/kategori');
        }

        $hapus = $this->kategoriModel->hapusKategori($id);
        if ($hapus == 0) {
            Flasher::setFlash('Kategori tidak ditemukan', 'danger');
            header('Location: ' . BASEURL . '/admin/kategori');
        } else {
            Flasher::setFlash('Kategori berhasil dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/kategori');
        }
    }

    public function about()
    {
        $data['title'] = 'About';
        $data['nama'] = $this->payload->nama;

        $this->view('admin/header', $data);
        $this->view('about/index', $data);
        $this->view('admin/footer');
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        setcookie('PPI-Login', '', time() - 3600 * 24 * 30, '/');
        header('Location: ' . BASEURL . '/login');
    }
}
