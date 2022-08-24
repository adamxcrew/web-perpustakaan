<?php

class Peminjaman_model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPinjaman()
    {
        $this->db->query("SELECT pinjaman.*, users.nama FROM pinjaman 
        JOIN users ON pinjaman.id_member = users.id
        ORDER BY tanggal_pinjam DESC");
        return $this->db->resultSet();
    }

    public function pinjamBelumKembali($data)
    {
        $id_member = $data['idmember'];
        $id_buku = $data['buku'];
        $sql = "SELECT pinjaman.id_pinjaman FROM pinjaman
                JOIN detail_pinjaman ON pinjaman.id_pinjaman = detail_pinjaman.id_pinjaman
                WHERE id_member = $id_member AND id_buku = $id_buku AND tanggal_kembali IS NULL";
        $this->db->query($sql);
        return $this->db->numRows();
    }

    public function countBelumKembali()
    {
        $sql = "SELECT COUNT(*) FROM pinjaman WHERE tanggal_kembali IS NULL";
        $this->db->query($sql);
        return $this->db->numRows();
    }

    public function simpanPinjaman($pinjaman, $id_member, $lama_pinjam)
    {
        $tanggal_pinjam = date('Y-m-d');

        //Insert get id
        $sql = "INSERT INTO pinjaman VALUES
                (null, :id_member, :tanggal_pinjam, :lama_pinjam, null, null)";
        $this->db->query($sql);
        $fields = [
            'id_member' => $id_member,
            'tanggal_pinjam' => $tanggal_pinjam,
            'lama_pinjam' => $lama_pinjam
        ];
        $this->db->binds($fields);
        // $this->db->bind('id_member', $id_member);
        // $this->db->bind('tanggal_pinjam', $tanggal_pinjam);
        // $this->db->bind('lama_pinjam', $lama_pinjam);
        $this->db->execute();
        $id_peminjaman = $this->db->lastInsertId();

        foreach ($pinjaman as $buku) {
            $sql = "INSERT INTO detail_pinjaman VALUES
                    (:id_peminjaman, '$buku[id_buku]')";
            $this->db->query($sql);
            $this->db->bind('id_peminjaman', $id_peminjaman);
            $this->db->execute();
        }
    }

    public function getPinjamanBuku($id_pinjaman)
    {
        $sql = "SELECT judul FROM buku
                JOIN detail_pinjaman ON detail_pinjaman.id_buku = buku.id
                WHERE id_pinjaman = '$id_pinjaman'";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getDetailPinjaman($id_pinjaman)
    {
        $sql = "SELECT tanggal_pinjam, tanggal_kembali, nama, lama_pinjam, denda FROM pinjaman
        JOIN users ON pinjaman.id_member = users.id
        WHERE id_pinjaman = '$id_pinjaman'";
        $this->db->query($sql);
        return $this->db->single();
    }

    public function getWaktuPinjaman($id_pinjaman)
    {
        $sql = "SELECT lama_pinjam, tanggal_pinjam FROM pinjaman WHERE id_pinjaman = '$id_pinjaman'";
        $this->db->query($sql);
        return $this->db->single();
    }

    public function updatePinjaman($id_pinjaman, $tanggal_kembali, $denda)
    {
        $sql = "UPDATE pinjaman
                    SET tanggal_kembali = :tanggal_kembali, denda = :denda
                    WHERE id_pinjaman = :id_pinjaman";
        $this->db->query($sql);
        $fields = [
            'tanggal_kembali' => $tanggal_kembali,
            'denda' => $denda,
            'id_pinjaman' => $id_pinjaman
        ];
        $this->db->binds($fields);
        // $this->db->bind('tanggal_kembali', $tanggal_kembali);
        // $this->db->bind('denda', $denda);
        // $this->db->bind('id_pinjaman', $id_pinjaman);
        $this->db->execute();
    }

    public function getPinjamanMember($id_member)
    {
        $sql = "SELECT id_pinjaman, tanggal_pinjam, lama_pinjam, tanggal_kembali FROM pinjaman 
        WHERE id_member = '$id_member'
        ORDER BY tanggal_pinjam DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
}
