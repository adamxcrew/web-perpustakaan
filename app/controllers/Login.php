<?php

class Login extends Controller {

    private $userModel;

    function __construct()
    {
        if (isset($_SESSION['user']['role'])) {
            if ($_SESSION['user']['role'] == 1) {
                header('Location: ' . BASEURL . '/admin');
            } else {
                header('Location: ' . BASEURL . '/member');
            }
        }

        $this->userModel = $this->model('User_model');
    }

    public function index() {
        $data['judul'] = 'Login';
        $this->view('auth/header', $data);
        $this->view('auth/login', $data);
        $this->view('auth/footer');
    }

    public function auth() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/login');
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $dbUser = $this->userModel->getUserByUsername($username);

        if (!$dbUser) {
            Flasher::setFlash('Username atau password salah.', 'danger');
            header('Location: ' . BASEURL . '/login');
        }

        if (password_verify($password, $dbUser['password'])) {
            $_SESSION['user'] = [
                'id' => $dbUser['id'],
                'username' => $username,
                'nama' => $dbUser['nama'],
                'role' => $dbUser['role']
            ];
            if ($_SESSION['user']['role'] == 1) {
                header('Location: ' . BASEURL . '/admin');
            } else {
                header('Location: ' . BASEURL . '/member');
            }
        } else {
            Flasher::setFlash('Username atau password salah.', 'danger');
            header('Location: ' . BASEURL . '/login');
        }
    }
}