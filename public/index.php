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
Route::post('/admin/users', [AdminController::class, 'createUser']);


// user router
// Route::get('/user', [ClientController::class, 'dashboard']);
Route::get('/user', [ClientController::class, 'profile']);
Route::post('/user/profile', [ClientController::class, 'updateProfile']);
Route::get('/user/accounts', [ClientController::class, 'showAccounts']);
Route::get('/user/depot', [ClientController::class, 'depot']);
Route::post('/deposit', [ClientController::class, 'addAmount']);






// API routes
Route::get('/api/users', [AdminController::class, 'getUsers']);
Route::get('/api/users/delete', [AdminController::class, 'deleteUser']);
Route::get('/api/users/ban', [AdminController::class, 'banUser']);
Route::get('/api/users/unban', [AdminController::class, 'unbanUser']);







$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);