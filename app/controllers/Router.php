<?php
class Router {
    public function handleRequest() {
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : DEFAULT_CONTROLLER . 'Controller';
        $actionName = isset($url[1]) ? $url[1] : DEFAULT_ACTION;

        if (file_exists('../app/controllers/' . $controllerName . '.php')) {
            require_once '../app/controllers/' . $controllerName . '.php';
            $controller = new $controllerName();

            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                // Gérer l'erreur 404
                require_once '../app/controllers/ErrorController.php';
                $errorController = new ErrorController();
                $errorController->notFound();
            }
        } else {
            // Gérer l'erreur 404
            require_once '../app/controllers/ErrorController.php';
            $errorController = new ErrorController();
            $errorController->notFound();
        }
    }
}

