<?php
session_start();
require_once ('../functions.php');


// includes 
require_once ('../core/BaseController.php');
require_once '../core/Router.php';
require_once '../core/Route.php';
require_once '../app/config/db.php';






$router = new Router();
Route::setRouter($router);




// auth routes 






// client router






// admin routers





















// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



