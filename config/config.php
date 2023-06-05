<?php

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');
define(
    'HOST',
    explode('/', $_SERVER['SERVER_PROTOCOL'])[0]
    . '://' .
    $_SERVER['REMOTE_ADDR'] . ':' .
    $_SERVER['SERVER_PORT'] . '/'
);

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
