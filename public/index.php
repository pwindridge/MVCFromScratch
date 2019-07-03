<?php

require '../core/bootstrap.php';

$routes = [
    '' => '../app/controllers/home.php',
    'home' => '../app/controllers/home.php',
    'about' => '../app/controllers/about.php'
];

$uri = trim($_SERVER['REQUEST_URI'], '/');

if (! array_key_exists($uri, $routes)) {
    die('Whoops! Resource not found!');
}

require $routes[$uri];