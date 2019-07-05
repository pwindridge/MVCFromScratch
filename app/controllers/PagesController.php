<?php


namespace Modules\Controllers;


class PagesController {

    private $modules = [
        "COMP50016" => "Server-Side Programming",
        "COSE50582" => "Object-Oriented Application Engineering",
        "COSE50586" => "Web and Mobile Application Development",
        "COSE50637" => "Engineering Software Applications"
    ];

    public function home()
    {
        $title = "Home Page";

        return view('home',
            [
                'title' => $title,
                'modules' => $this->modules
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

        return view ('addModule', compact('title'));
    }

    public function store()
    {
        $this->modules[$_POST['code']] = $_POST['module'];

        return $this->home();
    }
}