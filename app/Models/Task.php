<?php

namespace App\Models;

use App\Core\App;
use Exception;

class Task
{
    protected static $errors;
    protected static $name;
    protected static $user_id;
    protected static $status_id;
    protected static $priority_id;

    public static function connectDb()
    {
        return App::get('database');
    }

    public static function validateName($name)
    {
        if (strlen($name) < 1 || strlen($name) > 50)
        {
            self::$errors['name'] = 'Must have 1-50 characters';
            throw new Exception();
        }

        self::$name = $name;
    }

    public static function validateUser($id)
    {
        if (self::connectDb()->entityExists('users', $_POST['user_id'])[0])
        {
            self::$user_id = $id;
        }else
        {
            self::$errors['user'] = 'User not exists';
            throw new Exception();
        }
    }

    public static function validateStatus($id)
    {
        if (self::connectDb()->entityExists('statuses', $_POST['status_id'])[0])
        {
            self::$status_id = $id;
        }else
        {
            self::$errors['status'] = 'Status not exists';
            throw new Exception();
        }
    }

    public static function validatePriority($id)
    {
        if (self::connectDb()->entityExists('priorities', $_POST['priority_id'])[0])
        {
            self::$priority_id = $id;
        }else
        {
            self::$errors['priority'] = 'Priority not exists';
            throw new Exception();
        }
    }

    public static function validate()
    {
        try {
            self::validateName($_POST['task_name']);
            self::validateUser($_POST['user_id']);
            self::validateStatus($_POST['status_id']);
            self::validatePriority($_POST['priority_id']);

            unset($_SESSION['invalidData']);
            unset($_SESSION['errors']);
        }catch (Exception $e)
        {
            $_SESSION['invalidData'] = $_POST;

            return $_SESSION['errors'] = self::$errors;
        }
    }
}