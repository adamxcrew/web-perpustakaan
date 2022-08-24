<?php

class User_model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUserByUsername($username)
    {
        $this->db->query("SELECT * FROM users WHERE username = '$username'");
        return $this->db->single();
    }

    public function getUserByID($id)
    {
        $this->db->query("SELECT * FROM users WHERE id = '$id'");
        return $this->db->single();
    }

    public function checkUser($username)
    {
        $this->db->query("SELECT * FROM users WHERE username = '$username'");
        return $this->db->numRows();
    }

    public function checkUserByID($id)
    {
        $this->db->query("SELECT * FROM users WHERE id = '$id'");
        return $this->db->numRows();
    }

    public function countMember()
    {
        $this->db->query("SELECT COUNT(*) FROM users WHERE role = '2'");
        return $this->db->numRows();
    }

    public function insert($nama, $username, $password)
    {

        $new_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users VALUES 
                    (null, :username, :pass, 2, :nama)";

        $this->db->query($query);
        $fields = [
            'username' => $username,
            'pass' => $new_password,
            'nama' => $nama
        ];
        $this->db->binds($fields);
        // $this->db->bind('username', $username);
        // $this->db->bind('pass', $new_password);
        // $this->db->bind('nama', $nama);

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

    public function updateUser($id, $current_username, $data)
    {
        $new_username = htmlspecialchars($data['username']);
        $new_nama = htmlspecialchars($data['nama']);
        //Cek apakah username sudah ada
        if ($this->checkUser($new_username) > 0 && $current_username != $new_username) {
            return 0;
        } else {
            $sql = "UPDATE users 
                SET username = :new_username, nama = :new_nama
                WHERE id = :id";
            $this->db->query($sql);
            $fields = [
                'new_username' => $new_username,
                'new_nama' => $new_nama,
                'id' => $id
            ];
            $this->db->binds($fields);
            // $this->db->bind('new_username', $new_username);
            // $this->db->bind('new_nama', $new_nama);
            // $this->db->bind('id', $id);
            $this->db->execute();
        }
        $data['new_username'] = $new_username;
        $data['new_nama'] = $new_nama;
        return $data;
    }

    public function updatePassword($id, $new_password)
    {
        $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE users 
                SET password = :hash_password
                WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind('hash_password', $hash_password);
        $this->db->bind('id', $id);
        $this->db->execute();
    }
}
