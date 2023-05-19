<?php

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');

require '../vendor/autoload.php';

use Router\Router;

$router = new Router;
$router->get('/level/list', 'Controller\LevelController@list');
$router->get('/classe/list', 'Controller\ClasseController@list');
$router->get('/student/list', 'Controller\StudentController@list');
$router->handleRequest($_SERVER['REQUEST_URI']);
