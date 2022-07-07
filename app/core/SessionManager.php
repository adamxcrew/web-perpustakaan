<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class SessionManager
{
    private static string $SECRET_KEY = 'qwerty123321qwerty';

    public static function makeJwt(array $payload)
    {
        $jwt = JWT::encode($payload, SessionManager::$SECRET_KEY, 'HS256');
        return $jwt;
    }

    public static function checkSession()
    {
        if (isset($_COOKIE['PPI-Login'])) {
            return true;
        }

        return false;
    }

    public static function getCurrentSession()
    {

        $jwt = $_COOKIE['PPI-Login'];
        $payload = JWT::decode($jwt, new Key(SessionManager::$SECRET_KEY, 'HS256'));
        return $payload;
    }
}
