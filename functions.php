<?php
include 'koneksi.php';

function isLogin()
{
    if (isset($_SESSION['login'])) {
        return true;
    } else {
        return false;
    }
}

function isAdmin()
{
    if ($_SESSION['role'] == 1) {
        return true;
    } else {
        return false;
    }
}

function isMember()
{
    if ($_SESSION['role'] == 2) {
        return true;
    } else {
        return false;
    }
}

function login($username, $password)
{
    global $db;
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_num_rows($result);
    if ($row == 0) {
        return false;
    } else {
        $dbUser = mysqli_fetch_assoc($result);
        if (password_verify($password, $dbUser['password'])) {
            return $dbUser['role'];
        } else {
            return false;
        }
    }
}

function register($username, $password, $nama)
{
    global $db;
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        return false;
    } else {
        $new_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users VALUES 
                (null, '$username', '$new_password', 2, '$nama')";
        mysqli_query($db, $sql);
        return true;
    }
}
