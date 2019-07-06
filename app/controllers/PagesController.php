<?php

namespace Modules\Controllers;


use \Core\App;
use Exception;


class PagesController {

    public function home()
    {
        try {

            $modules = array_column(
                App::get('database')->selectAll('modules'),
                'module_name'
            );

        } catch (Exception $e) {
            return (new ErrorsController())->service_unavailable();
        }

        $title = "Home Page";

        return view('home',
            [
                'title' => $title,
                'modules' => $modules
            ]
        );
    }

    public function about()
    {

        $title = "About Us";

        return view('about', compact('title'));
    }

    public function search()
    {
        $title = "Search Code";
        $code = false;
        $moduleTitle = '';

        if (isset($_GET['title'])) {

            $code = App::get('database')
                ->select('modules', 'module_code')
                ->where('module_name', '=', $_GET['title']);
            dd($code);
            $moduleTitle = "value=\"{$_GET['title']}\"";
        }

        return view('search',
            compact('title', 'code', 'moduleTitle')
        );
    }

    public function addModule()
    {
        $title = "Add Module";

        return view('addModule', compact('title'));
    }

    public function store()
    {
        $this->modules[$_POST['code']] = $_POST['module'];

        return $this->home();
    }
}