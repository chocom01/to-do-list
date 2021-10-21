<?php

$router->get('', 'TasksController@index');
$router->get('new_task', 'TasksController@new');
$router->get('task', 'TasksController@show');
$router->post('create_task', 'TasksController@save');
$router->post('update_task', 'TasksController@update');
$router->post('delete_task', 'TasksController@delete');

