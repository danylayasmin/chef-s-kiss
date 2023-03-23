<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use RedBeanPHP\R as R;

require_once '../vendor/autoload.php';
//connect to database
R::setup('mysql:host=localhost;dbname=db', 'user', 'password');

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);

displayTemplate('welcome.twig', []);

//controller checken, params -> default
if (isset($_GET['controller'])) {
    $params = explode('/', $_GET['controller']);
    $controllerName = ucfirst($params[0]) . 'Controller';
    if (!class_exists($controllerName)) {
        error(404, 'Controller \'' . ucfirst($params[0]) . 'Controller\' not found');
    }
} else {
    $controllerName = "RecipeController";
}

// method checken -> default
if (isset($params[1])) {
    $method = $params[1];
    if (!method_exists($controllerName, $method)) {
        error(404, 'Method \'' . $params[1] . '\' not found');
        exit;
    }
} else {
    $method = 'index';
}

$controller = new $controllerName();
echo $controller->$method();
