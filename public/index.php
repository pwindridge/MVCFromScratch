<?php

require '../bootstrap.php';

$routes = [
    '' => '../home.php',
    'home' => '../home.php',
    'about' => '../about.php'
];

$uri = trim($_SERVER['REQUEST_URI'], '/');

if (! array_key_exists($uri, $routes)) {
    die('Whoops! Resource not found!');
}

require $routes[$uri];