<?php


namespace Modules\Controllers;


class ErrorsController {

    public function page_not_found()
    {
        $code = 404;
        $title = "404 - Page Not Found";
        $message = "Whoops! The resource that you were looking for cannot be found";

        http_response_code(404);

        return view ('error', compact ('code', 'title', 'message'));
    }
}