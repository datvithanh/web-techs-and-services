<?php
require dirname(__DIR__) . '/vendor/autoload.php';
/**
 * Error and Exception handling
 */
session_start();
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('/', ['controller' => 'HomeController', 'GET' => 'index']);
$router->add('/profile', ['controller' => 'HomeController', 'GET' => 'profile']);
$router->add('/register', ['controller' => 'HomeController', 'GET' => 'registerView', 'POST' => 'register']);
$router->add('/login', ['controller' => 'HomeController', 'GET' => 'loginView', 'POST' => 'login']);
$router->add('/logout', ['controller' => 'HomeController', 'GET' => 'logout']);

$router->add('/gym', ['controller' => 'GymController', 'GET' => 'get']);
$router->add('/gym/{id:\d+}/update', ['controller' => 'GymController', 'GET'  => 'updateView', 'POST' => 'update']);
$router->add('/gym/{id:\d+}/delete', ['controller' => 'GymController', 'GET' => 'delete']);
$router->add('/gym/create', ['controller' => 'GymController', 'GET' => 'createView', 'POST' => 'create']);
$router->add('/gym/{id:\d+}', ['controller' => 'GymController', 'GET' => 'info']);

$router->add('/session/{id:\d+}/update', ['controller' => 'SessionController', 'GET'  => 'updateView', 'POST' => 'update']);
$router->add('/session/{id:\d+}/delete', ['controller' => 'SessionController', 'GET' => 'delete']);
$router->add('/gym/{id:\d+}/session/create', ['controller' => 'SessionController', 'GET' => 'createView', 'POST' => 'create']);

// user accessible
$router->add('/gym-register', ['controller' => 'GymController', 'GET' => 'gymRegisterView']);
$router->add('/gym-register/{id:\d+}', ['controller' => 'GymController', 'GET' => 'gymRegister']);
$router->add('/cancel-gym-register/{id:\d+}', ['controller' => 'GymController', 'GET' => 'cancelGymRegister']);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);