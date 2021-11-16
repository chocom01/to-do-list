<?php

namespace App\Core;

use Exception;

class App
{
    protected static $registry = [];

    public static function bind($key, callable $value)
    {
        static::$registry[$key] = $value();
    }

    public static function get($key): mixed
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new Exception("No {$key} is bound in the container");
        }

        return static::$registry[$key];
    }
}