<?php

$code = 404;
$title = "404 - Page Not Found";
$message = "Whoops! The resource that you were looking for cannot be found";

http_response_code(404);

require '../views/error.view.php';

