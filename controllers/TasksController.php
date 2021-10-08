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
        App::get('database')->insert(
            'tasks', [
            'name' => $_POST['task_name'],
            'user_id' => $_POST['user_id'],
            'status_id' => $_POST['status_id'],
            'priority_id' => $_POST['priority_id']
        ]);

        return redirect('');
    }

    public function update()
    {
        App::get('database')->update(
            'tasks', [
            'name' => $_POST['name'],
            'id' => $_POST['id'],
            'status_id' => $_POST['status_id'],
            'priority_id' => $_POST['priority_id'],
            'user_id' => $_POST['user_id']
        ]);

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