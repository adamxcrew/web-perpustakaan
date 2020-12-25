<?php

class Home extends Controller {
    private $model;

    function __construct()
    {
        $this->model = $this->model('Buku_model');
    }

    public function index()
    {
        $data['judul'] = 'Home';
        $data['buku'] = $this->model->getAllBuku();
        $data['page'] = 'home';

        $this->view('home/index', $data);
    }
}
