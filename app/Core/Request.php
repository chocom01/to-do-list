<?php

namespace App\Core;

class Request
{
    public static function uri()
    {
        session_start();

        self::unsetErrors();

        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private static function unsetErrors()
    {
        if (self::urlNotEqualPreviously()) {
            unset($_SESSION['invalidData']);
            unset($_SESSION['errors']);
        }
    }

    private static function urlNotEqualPreviously()
    {
        $previouslyUrl = parse_url($_SERVER['HTTP_REFERER']);
        $currentUrl = parse_url($_SERVER['REQUEST_URI']);

        if (isset($previouslyUrl['query']) && isset($currentUrl['query'])) {
            $inequalityQuery = $previouslyUrl['query'] != $currentUrl['query'];
        } else {
            $inequalityQuery = true;
        }

        return $previouslyUrl['path'] != $currentUrl['path'] && $inequalityQuery;
    }
}