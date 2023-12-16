<?php
require_once __DIR__ . '/vendor/autoload.php';

use Ahmed\App\Router\Router;

$router = new Router();
require_once __DIR__ . '/routes/web.php';
echo $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);