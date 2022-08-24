<?php

class Buku_model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBuku()
    {
        $this->db->query("SELECT buku.*, kategori.nama_kategori FROM buku
        JOIN kategori ON id_kategori = kategori.id");
        return $this->db->resultSet();
    }

    public function getDetailBuku($id)
    {
        $this->db->query("SELECT buku.*, kategori.nama_kategori, penerbit.nama_penerbit FROM buku
        JOIN kategori ON buku.id_kategori = kategori.id
        JOIN penerbit ON buku.id_penerbit = penerbit.id
        WHERE buku.id = '$id'");
        return $this->db->single();
    }

    public function countBuku()
    {
        $this->db->query("SELECT COUNT(*) FROM buku");
        return $this->db->numRows();
    }

    public function tambahBuku($data)
    {
        $judul = htmlspecialchars($data['judul']);
        $penerbit = htmlspecialchars($data['penerbit']);
        $tahun = htmlspecialchars($data['tahun']);
        $penulis = htmlspecialchars($data['penulis']);
        $isbn = htmlspecialchars($data['isbn']);
        $kategori = htmlspecialchars($data['kategori']);
        $tgl_input = date('Y-m-d');

        $query = "INSERT INTO buku VALUES
        (null, :judul, :penerbit, :tahun, :penulis, :isbn, :kategori, :tgl_input)";

        $this->db->query($query);
        $fields = [
            'judul' => $judul,
            'penerbit' => $penerbit,
            'tahun' => $tahun,
            'penulis' => $penulis,
            'isbn' => $isbn,
            'kategori' => $kategori,
            'tgl_input' => $tgl_input
        ];
        $this->db->binds($fields);

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

    public function ubahBuku($id, $data)
    {
        $judul = htmlspecialchars($data['judul']);
        $penerbit = htmlspecialchars($data['penerbit']);
        $tahun = htmlspecialchars($data['tahun']);
        $penulis = htmlspecialchars($data['penulis']);
        $isbn = htmlspecialchars($data['isbn']);
        $kategori = htmlspecialchars($data['kategori']);

        $sql = "UPDATE buku SET
                judul = :judul,
                id_penerbit = :penerbit,
                tahun_terbit = :tahun,
                penulis = :penulis,
                isbn = :isbn,
                id_kategori = :kategori
                WHERE id = :id";

        $this->db->query($sql);
        $fields = [
            'judul' => $judul,
            'penerbit' => $penerbit,
            'tahun' => $tahun,
            'penulis' => $penulis,
            'isbn' => $isbn,
            'kategori' => $kategori,
        ];
        $this->db->binds($fields);

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

    public function hapusBuku($id)
    {
        //Cek apakah id buku ada dalam database
        $this->db->query("SELECT id FROM buku WHERE id = '$id'");
        $row = $this->db->numRows();
        //Jika row berisikan nilai 0 maka tidak ada buku yang ingin dihapus dalam database
        if ($row == 0) {
            return 0;
        }

        $this->db->query("DELETE FROM buku WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return 1;
    }
}
