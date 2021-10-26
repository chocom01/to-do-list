<?php

namespace App\Controllers;

use App\Models\Task;

class TasksController
{
    public function index()
    {
        $_SESSION['users'] = Task::connectDb()->selectTable('users');
        $_SESSION['statuses'] = Task::connectDb()->selectTable('statuses');
        $_SESSION['priorities'] = Task::connectDb()->selectTable('priorities');
        $sendData['tasks'] = Task::connectDb()->selectAll();

        return view('tasks', $sendData);
    }

    public function show()
    {
        parse_str($_SERVER['QUERY_STRING'], $queries);

        $_SESSION['task'] = Task::connectDb()->selectById('tasks', $queries['id']);

        return view('showTask');
    }

    public function newTask()
    {
        return view('createTask');
    }

    public function save()
    {
        if (Task::validate() !== null)
        {
            return redirect('newTask');
        }

        Task::connectDb()->insert(
            'tasks',
            [
                'name' => $_POST['task_name'],
                'user_id' => $_POST['user_id'],
                'status_id' => $_POST['status_id'],
                'priority_id' => $_POST['priority_id']
            ]
        );

        return redirect('home');
    }

    public function update()
    {
        if (Task::validate() !== null)
        {
            return redirect("task?id={$_POST['id']}");
        }

        Task::connectDb()->update(
            'tasks',
            [
            'name' => $_POST['task_name'],
            'id' => $_POST['id'],
            'status_id' => $_POST['status_id'],
            'priority_id' => $_POST['priority_id'],
            'user_id' => $_POST['user_id']
            ]
        );

        redirect("task?id={$_POST['id']}");
    }

    public function delete()
    {
        Task::connectDb()->delete(
            'tasks',
            [
            'id' => $_POST['id']
            ]
        );

        return redirect('home');
    }
}