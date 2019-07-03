<?php


namespace Modules\Controllers;


class PagesController {

    public function home() {

        $modules = [
            "COMP50016" => "Server-Side Programming",
            "COSE50582" => "Object-Oriented Application Engineering",
            "COSE50586" => "Web and Mobile Application Development",
            "COSE50637" => "Engineering Software Applications"
        ];

        $title = "Home Page";

        return view ('home', compact('title', 'modules'));
    }

    public function about() {

        $title = "About Us";

        return view ('about', compact('title'));
    }
}