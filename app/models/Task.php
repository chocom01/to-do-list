<?php

namespace App\Models;

use App\Core\App;
use Exception;

class Task
{
    public $connect;

    public function __construct()
    {
        $this->connect = App::get('database');
    }

    private function validateName($name)
    {
        if (strlen($name) < 1 || strlen($name) > 50)
        {
            $this->errors['name'] = 'Must have 1-50 characters';
            throw new Exception();
        }

        $this->name = $name;
    }

    private function validateUser($id)
    {
        if ($this->connect->entityExists('users', $_POST['user_id'])[0])
        {
            $this->user_id = $id;
        }else
        {
            $this->errors['user'] = 'User not exists';
            throw new Exception();
        }
    }

    private function validateStatus($id)
    {
        if ($this->connect->entityExists('statuses', $_POST['status_id'])[0])
        {
            $this->status_id = $id;
        }else
        {
            $this->errors['status'] = 'Status not exists';
            throw new Exception();
        }
    }

    private function validatePriority($id)
    {
        if ($this->connect->entityExists('priorities', $_POST['priority_id'])[0])
        {
            $this->priority_id = $id;
        }else
        {
            $this->errors['priority'] = 'Priority not exists';
            throw new Exception();
        }
    }

    public function validate($task)
    {
        try {
            $task->validateName($_POST['task_name']);
            $task->validateUser($_POST['user_id']);
            $task->validateStatus($_POST['status_id']);
            $task->validatePriority($_POST['priority_id']);
        }catch (Exception $e)
        {
            return $this->errors;
        }
    }
}