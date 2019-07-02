<?php

require '../bootstrap.php';

$routes = [
    '' => '../index.php',
    'index' => '../index.php',
    'home' => '../index.php',
    'about' => '../about.php'
];

$uri = trim($_SERVER['REQUEST_URI'], '/');

if (! array_key_exists($uri, $routes)) {
    die('Whoops! Resource not found!');
}

require $routes[$uri];