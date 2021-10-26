<?php

use App\Core\App;

App::bind('config', require 'config.php');

App::bind('database', new TaskQueryBuilder(
    Connection::make(App::get('config')['database'])
));

function view($name, $data = [])
{
    if (!isset($_SESSION))
    {
        redirect('home');
    }
    extract($data);

    return require "app/views/{$name}.view.php";
}

function redirect($path)
{
    header("Location: /{$path}");
}