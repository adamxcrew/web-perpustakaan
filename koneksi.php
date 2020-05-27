<?php
// Inisialisasi server dan database
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'perpustakaan';

// Koneksi ke database
$db = mysqli_connect($servername, $username, $password, $dbname);
