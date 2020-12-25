<?php

class Mahasiswa_model {
    
    private $table = 'mahasiswa';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllMahasiswa() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getMahasiswaByNim($nim) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nim=:nim');
        $this->db->bind('nim', $nim);
        return $this->db->single();
    }

    public function tambahDataMahasiswa($data) {
        $query = "INSERT INTO mahasiswa
                    VALUES
                    (:nim, :nama, :prodi, :email)";

        $this->db->query($query);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('prodi', $data['prodi']);
        $this->db->bind('email', $data['email']);

        try {
            $this->db->execute();
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return 0;
                die;
            }
        }

        return $this->db->rowCount();
    }

    public function hapusDataMahasiswa($nim) {
        $query = "DELETE FROM mahasiswa WHERE nim = :nim";
        $this->db->query($query);
        $this->db->bind('nim', $nim);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataMahasiswa($data) {
        $query = "UPDATE mahasiswa SET
                    nama = :nama,
                    prodi = :prodi,
                    email = :email
                    WHERE nim = :nim";

        $this->db->query($query);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('prodi', $data['prodi']);
        $this->db->bind('email', $data['email']);

        try {
            $this->db->execute();
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return 0;
                die;
            }
        }

        return $this->db->rowCount();
    }

    public function cariDataMahasiswa() {
        $keyword = $_POST['keyword'];
        $query = 'SELECT * FROM mahasiswa WHERE nama LIKE :keyword';
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}