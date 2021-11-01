<?php

namespace App\Models;

use App\Core\App;
use Exception;

class Task
{
    public static array $errors;
    public static string $name;
    public static int $user_id;
    public static int $status_id;
    public static int $priority_id;

    public static function connectDb()
    {
        return App::get('database');
    }

    public static function validateName($name)
    {
        if (strlen($name) < 1 || strlen($name) > 50)
        {
            self::$errors['name'] = 'Name must have 1-50 characters';
            throw new Exception();
        }

        self::$name = $name;
        return true;
    }

    public static function validateUser($id)
    {
        if (self::connectDb()->entityExists('users', $id)[0])
        {
            self::$user_id = $id;
            return true;
        }else
        {
            self::$errors['user'] = 'User not exists';
            throw new Exception();
        }
    }

    public static function validateStatus($id)
    {
        if (self::connectDb()->entityExists('statuses', $id)[0])
        {
            self::$status_id = $id;
            return true;
        }else
        {
            self::$errors['status'] = 'Status not exists';
            throw new Exception();
        }
    }

    public static function validatePriority($id)
    {
        if (self::connectDb()->entityExists('priorities', $id)[0])
        {
            self::$priority_id = $id;
            return true;
        }else
        {
            self::$errors['priority'] = 'Priority not exists';
            throw new Exception();
        }
    }

    public static function validate($post)
    {
        try {
            self::validateName($post['task_name']);
            self::validateUser($post['user_id']);
            self::validateStatus($post['status_id']);
            self::validatePriority($post['priority_id']);

            $_SESSION['unsetErrors'] = true;
        }catch (Exception $e)
        {
            $_SESSION['unsetErrors'] = false;
            $_SESSION['invalidData'] = $post;
            return $_SESSION['errors'] = self::$errors;
        }
    }
}