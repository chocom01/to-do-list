<?php

$router->get('home', 'TasksController@index');

$router->get('newTask', 'TasksController@newTask');

$router->get('task', 'TasksController@show');

$router->post('createTask', 'TasksController@save');

$router->post('updateTask', 'TasksController@update');

$router->post('deleteTask', 'TasksController@delete');

