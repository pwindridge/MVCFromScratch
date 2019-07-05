<?php


use \Core\{Request, Router};


require '../core/bootstrap.php';

try {

    Router::load('../routes.php')
        ->direct(Request::uri(), Request::method());

} catch (Exception $e) {

    header ("location: /pagenotfound");
}