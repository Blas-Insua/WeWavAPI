<?php
require_once './libs/Router.php';
require_once './app/controllers/tracksController.php';
require_once './app/controllers/accountsController.php';
require_once './app/controllers/authApiController.php';

// crea el router
$router = new Router();

// Tracks
$router->addRoute('tracks', 'GET', 'tracksController', 'getAll');
$router->addRoute('tracks/:ID', 'GET', 'tracksController', 'get');
$router->addRoute('tracks', 'POST', 'tracksController', 'upload'); 
$router->addRoute('tracks/:ID', 'DELETE', 'tracksController', 'delete');
$router->addRoute('tracks/:ID', 'PUT', 'tracksController', 'update'); 

// Accounts
$router->addRoute('accounts', 'GET', 'accountsController', 'getAll');
$router->addRoute('accounts/:ID', 'GET', 'accountsController', 'get');
$router->addRoute('accounts', 'POST', 'accountsController', 'create'); 
$router->addRoute('accounts/:ID', 'DELETE', 'accountsController', 'delete');
$router->addRoute('accounts/:ID', 'PUT', 'accountsController', 'update'); 

// Auth

$router->addRoute("auth/token", 'GET', 'authApiController', 'getToken');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);