<?php


namespace Modules\Controllers;


class ErrorsController {

    public function page_not_found()
    {
        $title = "404 - Page Not Found";
        $message = "Whoops! The resource that you were looking for cannot be found";

        http_response_code(404);

        return view('error', compact('title', 'message'));
    }

    public function service_unavailable()
    {
        $title = "503 - Service Unavailable";
        $message = "Whoops! The service is currently unavailable. Please try again later.";

        http_response_code(503);

        return view('error', compact('title', 'message'));
    }
}