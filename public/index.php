<?php

require '../vendor/autoload.php';
require '../app/Core/bootstrap.php';

use App\Core\Router;
use App\Core\Request;

try {
    Router::load('../routes.php')->direct(Request::uri(), Request::method());
} catch (Exception $e) {
}
