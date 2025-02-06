<?php
require_once __DIR__ . '/vendor/autoload.php';

use Core\Router;

// Load configuration
$config = require_once __DIR__ . '/config/config.php';

// Initialize the router
$router = new Router();

// Load routes
require_once __DIR__ . '/config/routes.php';

// Dispatch the request
$router->dispatch();