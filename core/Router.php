<?php


namespace Core;


use \Exception;

class Router {

    private $routes;

    /**
     * @param array $routes
     */
    public function get(string $uri, string $route)
    {
        $this->routes['GET'][$uri] = $route;
    }

    /**
     * @param array $routes
     */
    public function post(string $uri, string $route)
    {
        $this->routes['POST'][$uri] = $route;
    }

    public static function load(string $file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    /**
     * @param string $uri
     * @return string filepath
     * @throws Exception
     */
    public function direct (string $uri, string $method)
    {
        if (! array_key_exists($uri, $this->routes[$method])) {
            throw new Exception("Array key does not exist");
        }

        return $this->call(
            ...explode('@', $this->routes[$method][$uri])
        );
    }

    private function call($controller, $action)
    {
        $controller = "\\Modules\\Controllers\\{$controller}";

        if (! method_exists($controller, $action)) {
            throw new Exception("Method does not exist in the controller");
        }

        return (new $controller())->$action();
    }
}