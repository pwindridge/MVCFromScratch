<?php


use \Core\{Request, Router};
use \Modules\Controllers\ErrorsController;


require '../core/bootstrap.php';

try {

    Router::load('../routes.php')
        ->direct(Request::uri(), Request::method());

} catch (Exception $e) {
    return (new ErrorsController())->page_not_found();
}