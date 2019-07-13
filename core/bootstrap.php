<?php


use \Core\{
    App,
    Database\Connection,
    Database\QueryBuilder,
    Session\DatabaseSessionHandler,
    Validation\Errors
};


require "../vendor/autoload.php";

require 'functions.php';

App::bind('config', require '../config.php');

App::bind('PDOConn', Connection::make(App::get('config')['database']));

App::bind('database', new QueryBuilder(App::get('PDOConn')));

App::bind('errors', new Errors());

new DatabaseSessionHandler();