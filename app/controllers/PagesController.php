<?php

namespace Modules\Controllers;


use \Core\App;
use Exception;
use PDO;


class PagesController {

    public function home()
    {
        $_SESSION['user'] = 'logged in';
        try {

            $modules = App::get('database')->selectAll('modules');

        } catch (Exception $e) {
            return (new ErrorsController())->service_unavailable();
        }

        $userStatus = $_SESSION['user'];


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

    public function detail()
    {
        $title = "Module Detail";

        $view = 'detail';

        if (isset($_GET['mode'])) {
            $view = $_GET['mode'] == 'edit' ? 'edit' : 'delete';
        }

        $record = App::get('database')->select('modules', ['module_code', 'module_name'])
            ->where('module_code', '=', $_GET['code'])
            ->execute()
            ->fetch();

        return view ($view, compact('title','record'));
    }

    public function edit()
    {
        App::get('database')->update('modules', [
            'module_code' => $_POST['module_code'],
            'module_name' => $_POST['module_name']
        ])
            ->where('module_code', '=', $_POST['original_module_code'])
            ->execute();

        return $this->home();
    }

    public function delete()
    {
        App::get('database')->delete('modules')
            ->where('module_code', '=', $_POST['module_code'])
            ->execute();

        return $this->home();
    }
}