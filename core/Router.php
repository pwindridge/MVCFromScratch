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
            throw new Exception("Array key does not exist");
        }

        return $this->call(
            ...explode('@', $this->routes[$uri])
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