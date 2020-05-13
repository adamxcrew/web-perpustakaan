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