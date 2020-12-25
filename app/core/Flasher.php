<?php

class Flasher {

    public static function setFlash($pesan, $tipe) {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'tipe' => $tipe];
    }

    public static function flash() {
        if (isset($_SESSION['flash'])) {
            $flash['pesan'] = $_SESSION['flash']['pesan'];
            $flash['tipe'] = $_SESSION['flash']['tipe'];
            unset($_SESSION['flash']);
            return $flash;
        }
    }

    public static function check() {
        if (isset($_SESSION['flash'])) {
            return true;
        }
    }
}