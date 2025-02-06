<?php
namespace Core;

class Router {
    private $routes = [];

    public function add($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch() {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
           
            if ($this->matchRoute($uri, $route['path']) && $method === $route['method']) {
                
             echo '<pre>';
             var_dump($route['controller']);
             echo '</pre>';

                $controller = "App\\Controllers\\" . $route['controller'];
                $action = $route['action'];
                
                if (class_exists($controller)) {
                    echo $action;
                    $controllerInstance = new $controller();
                    if (method_exists($controllerInstance, $action)) {
                        return $controllerInstance->$action();
                    }
                }
            }
        }
        
        // Route non trouvée
    }

    private function matchRoute($uri, $path) {
      
        return $uri === $path;
    }
}

