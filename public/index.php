<?php

header('Access-Control-Allow-Origin: *');

require_once '../vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/config.php';

const ROOT_CONFIG = __DIR__ . "/../config/Root.ini";
use Router\Router;
use Controller\Session;

Session::init();

$router = new Router;

// $routeController->controller('Controller\Authentification', [
//     'GET' => [
//         ['/login/view', 'view'],
//         ['/login/disconnect/{param}', 'disconnect']
//     ],
//     'POST' => ['/login/check', 'check'],
//     'POST' => ['/login/verify', 'verify'],
// ]);

// $rootSettings = parse_ini_file(ROOT_CONFIG);
define('ROOT_PATH', parse_ini_file(ROOT_CONFIG));

$router->get(ROOT_PATH['login']['view'], 'Controller\Authentification@view');
$router->post(ROOT_PATH['login']['check'], 'Controller\Authentification@check');
$router->post(ROOT_PATH['login']['verify'], 'Controller\Authentification@verify');
$router->get(ROOT_PATH['login']['disconnect'], 'Controller\Authentification@disconnect');

$router->get(ROOT_PATH['level']['list'], 'Controller\LevelController@list');
$router->post(ROOT_PATH['level']['add'], 'Controller\LevelController@insert');

$router->get(ROOT_PATH['classe']['list'], 'Controller\ClasseController@list');
$router->post(ROOT_PATH['classe']['add'], 'Controller\ClasseController@insert');
$router->post(ROOT_PATH['classe']['edit'], 'Controller\ClasseController@edit');
$router->get(ROOT_PATH['classe']['in-level'], 'Controller\ClasseController@getByLevel');
$router->get(ROOT_PATH['classe']['by-level'], 'Controller\ClasseController@byLevelId');

$router->get(ROOT_PATH['schoolyear']['list'], 'Controller\SchoolYearController@list');
$router->post(ROOT_PATH['schoolyear']['add'], 'Controller\SchoolYearController@insert');
$router->get(ROOT_PATH['schoolyear']['edit'], 'Controller\SchoolYearController@edit');
$router->get(ROOT_PATH['schoolyear']['delete'], 'Controller\SchoolYearController@delete');
$router->get(ROOT_PATH['schoolyear']['enable'], 'Controller\SchoolYearController@enable');

$router->get(ROOT_PATH['student']['list'], 'Controller\StudentController@list');
$router->post(ROOT_PATH['student']['add'], 'Controller\StudentController@add');
$router->get(ROOT_PATH['student']['in-classe'], 'Controller\StudentController@getByClasse');

$router->get(ROOT_PATH['subject-group']['list'], 'Controller\SubjectGroupController@all');
$router->post(ROOT_PATH['subject-group']['add'], 'Controller\SubjectGroupController@insert');

$router->get(ROOT_PATH['subject']['view'], 'Controller\SubjectController@render');
$router->get(ROOT_PATH['subject']['list'], 'Controller\SubjectController@all');
$router->get(ROOT_PATH['subject']['in-classe'], 'Controller\SubjectController@byClasse');
$router->post(ROOT_PATH['subject']['add'], 'Controller\SubjectController@insert');
$router->post(ROOT_PATH['subject']['delete'], 'Controller\SubjectController@deleteFromClasse');

$requestPath = explode('?', $_SERVER['REQUEST_URI'])[0];
$router->handleRequest($requestPath);

