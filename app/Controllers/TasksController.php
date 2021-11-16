<?php

namespace App\Controllers;

use App\Models\Task;
use App\Validators\TaskValidator;

class TasksController
{
    public function index()
    {
        $currentQuery = $this->currentQueryStrings();

        $sortOrder = $this->sortOrder($currentQuery);
        $pages = Task::countPages($currentQuery['limit']);
        $limits = [10,25,50];

        $tasks = Task::all(
            [
                'page' => $currentQuery['page'], 'limit' => $currentQuery['limit'],
                'orderBy' => $currentQuery['orderBy'], 'sortBy' => $currentQuery['sortBy']
            ]
        );

        return $this->view('tasks', compact('tasks', 'pages', 'limits', 'currentQuery', 'sortOrder'));
    }

    public function show()
    {
        $associatedData = $this->associatedData();

        $task = Task::selectById($this->getQueryString('id'));

        if (isset($_SESSION['invalidData'])) {
            $task = (object) $_SESSION['invalidData'];
            $errors = $_SESSION['errors'];
        }

        return $this->view('showTask', compact('task', 'associatedData', 'errors'));
    }

    public function newTask()
    {
        $associatedData = $this->associatedData();

        if (isset($_SESSION['invalidData'])) {
            $invalidData = (object) $_SESSION['invalidData'];
            $errors = $_SESSION['errors'];
        }

        return $this->view('createTask', compact('associatedData', 'invalidData', 'errors'));
    }

    public function save()
    {
        $validatedData = TaskValidator::validate($_POST);

        if (!$validatedData) {
            redirectBack();
        }

        $task = new Task();
        $task->create($validatedData);

        redirectRoot();
    }

    public function update()
    {
        $validatedData = TaskValidator::validate($_POST);

        if (!$validatedData) {
            redirectBack();
        }

        task::update($validatedData);

        redirectBack();
    }

    public function delete()
    {
        Task::delete($_POST['id']);

        redirectRoot();
    }

    private function view($name, $data = [])
    {
        extract($data);

        return require "../app/views/{$name}.view.php";
    }

    private function associatedData(): array
    {
        return [
            'users' => Task::buildQuery()->selectTable('users'),
            'statuses' => Task::buildQuery()->selectTable('statuses'),
            'priorities' => Task::buildQuery()->selectTable('priorities')
        ];
    }

    private function getQueryString($queryString, $elseStatement = '')
    {
        parse_str($_SERVER['QUERY_STRING'], $queries);

        if ($queries[$queryString] !== null) {
            return $queries[$queryString];
        } else {
            return $elseStatement;
        }
    }

    private function currentQueryStrings()
    {
        return [
            'page' => $this->getQueryString('page', 1),
            'limit' => $this->getQueryString('limit', 10),
            'orderBy' => $this->getQueryString('orderBy', 'id'),
            'sortBy' => $this->getQueryString('sortBy', 'asc')
        ];
    }

    private function defineSortOrder($currentQuery, $columnName): array
    {
        if ($currentQuery['orderBy'] !== $columnName) {
            return [
                'query' => '?' . http_build_query(array_replace($currentQuery, ['orderBy' => $columnName])),
                'class' => 'passive'
            ];
        }
        if ($currentQuery['sortBy'] === 'asc') {
            return [
                'query' => '?' . http_build_query(array_replace($currentQuery, ['sortBy' => 'desc'])),
                'class' => 'sortUp'
            ];
        } else {
            return [
                'query' => '?' . http_build_query(array_replace($currentQuery, ['sortBy' => 'asc'])),
                'class' => 'sortDown'
            ];
        }
    }

    private function sortOrder($currentQuery): array
    {
        return [
            'name' => $this->defineSortOrder($currentQuery, 'name'),
            'user' => $this->defineSortOrder($currentQuery, 'user_id'),
            'status' => $this->defineSortOrder($currentQuery, 'status_id'),
            'priority' => $this->defineSortOrder($currentQuery, 'priority_id')
        ];
    }
}
