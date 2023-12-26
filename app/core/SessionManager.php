<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class SessionManager
{
    private static string $SECRET_KEY = 'qwertyuiopasdfghjklzxcvbnm1234567890';

    public static function makeJwt(array $payload)
    {
        $jwt = \Firebase\JWT\JWT::encode($payload, SessionManager::$SECRET_KEY, 'HS256');
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
        $payload = \Firebase\JWT\JWT::decode($jwt, new \Firebase\JWT\Key(SessionManager::$SECRET_KEY, 'HS256'));
        return $payload;
    }
}