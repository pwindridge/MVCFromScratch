<?php


use \Core\{Request, Router};


require '../core/bootstrap.php';

try {

    Router::load('../routes.php')
        ->direct(Request::uri());

} catch (Exception $e) {

    header ("location: /pagenotfound");
}