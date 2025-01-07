<?php 
session_start();
require_once __DIR__.'/../core/functions.php';
require_once '../core/BaseController.php';
require_once '../core/Router.php';
require_once '../core/Route.php';
require_once __DIR__.'/../app/controllers/AuthController.php'; 
require_once __DIR__.'/../app/controllers/AdminController.php'; 
require_once __DIR__.'/../app/controllers/ClientController.php'; 
require_once(__DIR__.'/../app/config/Database.php');


$router = new Router();
Route::setRouter($router);

//  auth router

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/logout', [AuthController::class, 'handleLogout']);



//admin router

Route::get('/admin', [AdminController::class, 'dashboard']);


// user router
Route::get('/user', [ClientController::class, 'dashboard']);
Route::get('/user/profile', [ClientController::class, 'profile']);






$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);