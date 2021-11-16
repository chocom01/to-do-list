<?php

use App\Core\App;
use App\Core\Database\Connection;
use App\Core\Database\TaskQueryBuilder;

App::bind('config', function () {
    return require '../config.php';
});

App::bind('taskQueryBuilder', function () {
    $dbConfig = App::get('config')['database'];
    $dbConnection = Connection::make($dbConfig);
    return new TaskQueryBuilder($dbConnection);
});

function redirect($path)
{
    header("Location: tasks/{$path}");
}

function redirectBack()
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function redirectRoot()
{
    header("Location: tasks/?page=1&limit=10&orderBy=status_id&sortBy=asc");
}