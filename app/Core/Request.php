<?php

namespace App\Core;

class Request
{
    public static function uri()
    {
        session_start();

        self::unsetErrors();

        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private static function unsetErrors()
    {
        if (
            parse_url($_SERVER['HTTP_REFERER'])['path'] !== $_SERVER['PATH_INFO']
            || $_SESSION['unsetErrors']
        )
        {
            unset($_SESSION['invalidData']);
            unset($_SESSION['errors']);
        }
    }
}