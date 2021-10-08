<?php

$router->get('', 'TasksController@index');
$router->post('tasks', 'TasksController@create');
$router->post('update_task', 'TasksController@update');
$router->post('delete_task', 'TasksController@delete');

