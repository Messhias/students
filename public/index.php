<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// home router
$router->add('', ['controller' => 'HomeController', 'action' => 'index', "title"]);
$router->add('{controller}/{action}');
$router->add('/', ['controller' => 'HomeController', 'action' => 'index', "title"]);
$router->add('{controller}/{action}');

// students ajax api route
$router->add('/students', ['controller' => 'StudentsController', 'action' => 'get', "title"]);
$router->add('{controller}/{action}');

// add new student route
$router->add('/students/add', [
   'controller' => 'StudentsController',
   'action' => 'create',
]);
$router->add('{controller}/{action}');

// find student route
$router->add('/students/find', [
   'controller' => 'StudentsController',
   'action' => 'find',
]);
$router->add('{controller}/{action}');

// update students route
$router->add('/students/edit', [
    'controller' => 'StudentsController',
    'action' => 'update',
]);
$router->add('{controller}/{action}');

// delete students route
$router->add('/students/delete', [
    'controller' => 'StudentsController',
    'action' => 'delete',
]);
$router->add('{controller}/{action}');

// removing the ? after from students request in get action
$url = explode("?" , $_SERVER['REQUEST_URI']);

if (count($url) > 1) {
    $url = $url[0];
    $router->dispatch($url);
} else
    $router->dispatch($_SERVER['REQUEST_URI']);


