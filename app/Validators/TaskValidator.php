<?php

namespace App\Validators;

use App\Core\App;
use Exception;

class TaskValidator
{
    public static array $errors = [];
    public static string $name;
    public static int $user_id;
    public static int $status_id;
    public static int $priority_id;

    public static function getBuilder(): mixed
    {
        return App::get('taskQueryBuilder');
    }

    public static function validateName($name): bool
    {
        if (strlen($name) < 1 || strlen($name) > 50) {
            self::$errors['name'] = 'Name must have 1-50 characters';
            throw new Exception();
        }

        self::$name = $name;
        return true;
    }

    public static function validateUser($user_id): bool
    {
        if (self::getBuilder()->entityExists('users', $user_id)[0]) {
            self::$user_id = $user_id;
            return true;
        } else {
            self::$errors['user'] = 'User not exists';
            throw new Exception();
        }
    }

    public static function validateStatus($status_id): bool
    {
        if (self::getBuilder()->entityExists('statuses', $status_id)[0]) {
            self::$status_id = $status_id;
            return true;
        } else {
            self::$errors['status'] = 'Status not exists';
            throw new Exception();
        }
    }

    public static function validatePriority($priority_id): bool
    {
        if (self::getBuilder()->entityExists('priorities', $priority_id)[0]) {
            self::$priority_id = $priority_id;
            return true;
        } else {
            self::$errors['priority'] = 'Priority not exists';
            throw new Exception();
        }
    }

    public static function validate($post): bool|array
    {
        try {
            self::validateName($post['name']);
            self::validateUser($post['user_id']);
            self::validateStatus($post['status_id']);
            self::validatePriority($post['priority_id']);

            self::unsetErrors();

            return self::validatedData($post['id']);
        } catch (Exception $e) {
            $_SESSION['invalidData'] = $post;
            $_SESSION['errors'] = self::$errors;
            return false;
        }
    }

    private static function validatedData($id): array
    {
        $validatedData = [
            'name' => self::$name,
            'user_id' => self::$user_id,
            'status_id' => self::$status_id,
            'priority_id' => self::$priority_id
        ];

        if (isset($id)) {
            $validatedData['id'] = $id;
        }

        return $validatedData;
    }

    private static function unsetErrors()
    {
        if (isset($_SESSION['invalidData']) || isset($_SESSION['errors'])) {
            unset($_SESSION['invalidData']);
            unset($_SESSION['errors']);
        }
    }
}
