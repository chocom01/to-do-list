<?php

namespace App\Controllers;

use App\Models\Task;

class TasksController
{
    public $task;

    public function __construct()
    {
        $this->task = new Task;
    }

    public function index()
    {
        $sendData = $this->mandatoryData();
        $sendData['tasks'] = $this->task->connect->selectAll();
        return view('tasks', $sendData);
    }

    public function show()
    {
        $sendData = $this->mandatoryData();
        parse_str($_SERVER['QUERY_STRING'], $queries);

        $sendData['task'] = $this->task->connect->selectById('tasks', $queries['id']);

        return view('show_task', $sendData);

    }

    public function new()
    {
        return view('createTask', $this->mandatoryData());
    }

    public function save()
    {
        if ($this->task->validate($this->task) !== null)
        {
            $sendData = $this->mandatoryData();

            $sendData['invalidData'] = $_POST;
            $sendData['errors'] = $this->task->validate($this->task);
            return view( 'createTask', $sendData);
        }

        $this->task->connect->insert(
            'tasks',
            [
                'name' => $_POST['task_name'],
                'user_id' => $_POST['user_id'],
                'status_id' => $_POST['status_id'],
                'priority_id' => $_POST['priority_id']
            ]
        );
        return redirect('');
    }

    public function update()
    {
        if ($this->task->validate($this->task) !== null)
        {
            $sendData = $this->mandatoryData();

            $sendData['task'] = $this->task->connect->selectById('tasks', $_POST['id']);
            $sendData['invalidData'] = $_POST;
            $sendData['errors'] = $this->task->validate($this->task);

            return view('show_task', $sendData);
        }

        $this->task->connect->update(
            'tasks',
            [
            'name' => $_POST['task_name'],
            'id' => $_POST['id'],
            'status_id' => $_POST['status_id'],
            'priority_id' => $_POST['priority_id'],
            'user_id' => $_POST['user_id']
            ]
        );

        return redirect("task?id={$_POST['id']}");
    }

    public function delete()
    {
        $this->task->connect->delete(
            'tasks',
            [
            'id' => $_POST['id']
            ]
        );

        return redirect('');
    }

    private function mandatoryData()
    {
        return [
            'users' => $this->task->connect->selectTable('users'),
            'statuses' => $this->task->connect->selectTable('statuses'),
            'priorities' => $this->task->connect->selectTable('priorities'),
        ];
    }
}