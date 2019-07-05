<?php


use \Core\{
    App, Database\Connection, Database\QueryBuilder
};


require "../vendor/autoload.php";

require 'functions.php';

App::bind('config', require '../config.php');

App::bind('database', new QueryBuilder(
        Connection::make(App::get('config')['database'])
    )
);