-- Create database
CREATE DATABASE perpustakaan;

-- Gunakan database
USE perpustakaan;

-- Table penerbit
CREATE TABLE penerbit (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama_penerbit VARCHAR(128),
    alamat VARCHAR(128),
    no_telp VARCHAR(20)
);

-- Table kategori
CREATE TABLE kategori (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama_kategori VARCHAR(64),
    keterangan VARCHAR(128)
);

-- Table buku
CREATE TABLE buku (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    judul VARCHAR(128),
    id_penerbit INT,
    tahun_terbit CHAR(4),
    penulis VARCHAR(128),
    isbn VARCHAR(20),
    id_kategori INT,
    FOREIGN KEY (id_penerbit) REFERENCES penerbit(id),
    FOREIGN KEY (id_kategori) REFERENCES kategori(id)
);

-- Table users
CREATE TABLE users (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    username VARCHAR(32) UNIQUE,
    password VARCHAR(255),
    role CHAR(1),
    nama VARCHAR(64)
);

-- Table transaksi
CREATE TABLE pinjaman (
    id_pinjaman INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_member INT,
    tanggal_pinjam DATE,
    lama_pinjam INT,
    tanggal_kembali DATE,
    denda INT
);

-- Table detail transaksi
CREATE TABLE detail_transaksi (
    id_pinjaman INT NOT NULL,
    id_buku INT NOT NULL,
    FOREIGN KEY (id_pinjaman) REFERENCES pinjaman(id_pinjaman),
    FOREIGN KEY (id_buku) REFERENCES buku(id_buku)
);