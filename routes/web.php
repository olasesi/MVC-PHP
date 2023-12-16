<?php
use Ahmed\App\Http\Controllers\HomeController;


$router->get('/', [HomeController::class, 'index']);