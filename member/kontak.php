<?php
session_start();
include '../functions.php';

//Cek apakah sudah login dan member
if (!isLogin() || !isMember()) {
    header('Location:../login.php');
}

$title = 'Kontak';
?>
<?php include 'header.php' ?>
<div class="container py-3">
    <h3 class="mt-5 pt-2">Hubungi Kami</h3>
</div>
<?php include 'footer.php' ?>