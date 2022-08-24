<?php

class Penerbit_model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPenerbit()
    {
        $this->db->query("SELECT * FROM penerbit");
        return $this->db->resultSet();
    }

    public function getPenerbitById($id)
    {
        $this->db->query("SELECT * FROM penerbit WHERE id = '$id'");
        return $this->db->single();
    }

    public function insertPenerbit($data)
    {
        $nama_penerbit = htmlspecialchars($data['nama_penerbit']);
        $alamat = htmlspecialchars($data['alamat']);
        $no_telp = htmlspecialchars($data['no_telp']);

        $sql = "INSERT INTO penerbit VALUES
        (null, :nama_penerbit, :alamat, :no_telp)";
        $this->db->query($sql);
        $fields = [
            'nama_penerbit' => $nama_penerbit,
            'alamat' => $alamat,
            'no_telp' => $no_telp
        ];
        $this->db->binds($fields);
        // $this->db->bind('nama_penerbit', $nama_penerbit);
        // $this->db->bind('alamat', $alamat);
        // $this->db->bind('no_telp', $no_telp);
        $this->db->execute();
    }

    public function updatePenerbit($id, $data)
    {
        $nama_penerbit = htmlspecialchars($data['nama_penerbit']);
        $alamat = htmlspecialchars($data['alamat']);
        $no_telp = htmlspecialchars($data['no_telp']);

        $sql = "UPDATE penerbit SET
                nama_penerbit = :nama_penerbit,
                alamat = :alamat,
                no_telp = :no_telp
                WHERE id = :id";
        $this->db->query($sql);
        $fields = [
            'nama_penerbit' => $nama_penerbit,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'id' => $id
        ];
        $this->db->binds($fields);
        // $this->db->bind('nama_penerbit', $nama_penerbit);
        // $this->db->bind('alamat', $alamat);
        // $this->db->bind('no_telp', $no_telp);
        // $this->db->bind('id', $id);
        $this->db->execute();
    }

    public function hapusPenerbit($id)
    {
        //Cek apakah id penerbit ada dalam database
        $this->db->query("SELECT id FROM penerbit WHERE id = '$id'");
        $row = $this->db->numRows();
        //Jika row berisikan nilai 0 maka tidak ada penerbit yang ingin dihapus dalam database
        if ($row == 0) {
            return 0;
        }
        $this->db->query("DELETE FROM penerbit WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return 1;
    }
}
