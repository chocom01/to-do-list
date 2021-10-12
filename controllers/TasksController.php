<?php

namespace App\Controllers;

use App\Core\App;

class TasksController
{
    public function index()
    {
        $tasks = App::get('database')->selectAll();
        $users = App::get('database')->selectTable('users');
        $statuses = App::get('database')->selectTable('statuses');
        $priorities = App::get('database')->selectTable('priorities');

        return view('tasks', compact('tasks', 'users', 'statuses', 'priorities'));
    }

    public function create()
    {
        $userId = App::get('database')->validate('users', $_POST['user_id'])[0];
        $statusId = App::get('database')->validate('statuses', $_POST['status_id'])[0];
        $priorityId = App::get('database')->validate('priorities', $_POST['priority_id'])[0];
        $nameLength = strlen($_POST['task_name']);

        if ($nameLength > 0 && $nameLength <= 50 &&
            $userId && $statusId && $priorityId
        ) {
            App::get('database')->insert(
                'tasks', [
                'name' => $_POST['task_name'],
                'user_id' => $_POST['user_id'],
                'status_id' => $_POST['status_id'],
                'priority_id' => $_POST['priority_id']
            ]);
        } else {
            die("not a valid");
        }

        return redirect('');
    }

    public function update()
    {
        $userId = App::get('database')->validate('users', $_POST['user_id'])[0];
        $statusId = App::get('database')->validate('statuses', $_POST['status_id'])[0];
        $priorityId = App::get('database')->validate('priorities', $_POST['priority_id'])[0];
        $nameLength = strlen($_POST['task_name']);

        if ($nameLength > 0 && $nameLength <= 50 &&
            $userId && $statusId && $priorityId
        ) {
        App::get('database')->update(
            'tasks', [
            'name' => $_POST['task_name'],
            'id' => $_POST['id'],
            'status_id' => $_POST['status_id'],
            'priority_id' => $_POST['priority_id'],
            'user_id' => $_POST['user_id']
        ]);
        } else {
            die("is not a valid");
        }

        return redirect('');
    }

    public function delete()
    {
        App::get('database')->delete(
            'tasks', [
            'id' => $_POST['id']
        ]);

        return redirect('');
    }
}