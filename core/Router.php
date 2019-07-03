<?php


namespace Core;


use \Exception;

class Router {

    private $routes;

    /**
     * @param array $routes
     */
    public function define(array $routes)
    {
        $this->routes = $routes;
    }

    public static function load(string $file)
    {
        $router = new static;
        $router->define(require $file);
        return $router;
    }

    /**
     * @param string $uri
     * @return string filepath
     * @throws Exception
     */
    public function direct (string $uri)
    {
        if (! array_key_exists($uri, $this->routes)) {
            throw new Exception();
        }

        return $this->routes[$uri];
    }
}