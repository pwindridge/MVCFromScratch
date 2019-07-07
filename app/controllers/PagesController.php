<?php

namespace Modules\Controllers;


use \Core\App;
use Exception;
use PDO;


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

            try {

                $code = App::get('database')
                    ->select('modules', ['module_code'])
                    ->where('module_name', '=', $_GET['title'])
                    ->execute()
                    ->fetch()->module_code;

            } catch (\PDOException $pexc) {
                $code = "The module code for {$_GET['title']} could not be found";
            }

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
        try {

            App::get('database')->insert('modules', [
                'module_code' => $_POST['code'],
                'module_name' => $_POST['module']
            ]);

        } catch (\PDOException $pexc) {

            return view('addModule',  [
                'title' => "Add Module",
                'moduleCode' => " value=\"{$_POST['code']}\"",
                'moduleName' => " value=\"{$_POST['module']}\""
            ]);
        }
        return $this->home();
    }
}