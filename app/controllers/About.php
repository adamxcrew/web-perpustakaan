<?php

class About extends Controller {
    public function index($nama = 'Tedja', $alamat = 'Badung') {
        $data['nama'] = $nama;
        $data['alamat'] = $alamat;
        $data['judul'] = 'About Me';
        $data['page'] = 'about';
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }
}