<?php


use \Core\{
    App,
    Database\Connection,
    Database\QueryBuilder,
    Session\DatabaseSessionHandler
};


require "../vendor/autoload.php";

require 'functions.php';

App::bind('config', require '../config.php');

App::bind('PDOConn', Connection::make(App::get('config')['database']));

App::bind('database', new QueryBuilder(App::get('PDOConn')));

new DatabaseSessionHandler();