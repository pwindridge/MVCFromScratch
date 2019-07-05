<?php

namespace Modules\Controllers;


use \PDO, \PDOException;


class PagesController {

    public function home()
    {
        try {
            $pdo = new PDO (
                "mysql:host=localhost;dbname=test",
                "test",
                "test",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]
            );

            $sth = $pdo->prepare("SELECT * FROM `modules`;");

            $sth->execute();

        } catch (PDOException $e) {
            return (new ErrorsController())->service_unavailable();
        }

        $modules = array_column($sth->fetchAll(), 'module_name');

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
            $code = array_search($_GET['title'], $this->modules);
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