<?php

require_once '../vendor/autoload.php';
require_once '../controllers/RecipeController.php';
require_once '../controllers/KitchenController.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);

displayTemplate('welcome.twig', []);

//controller checken, params -> default
if (isset($_GET['controller'])) {
    $params = explode('/', $_GET['controller']);
    $controllerName = ucfirst($params[0]) . 'Controller';
} else {
    $controllerName = "RecipeController";
}

// method checken -> default
if (isset($params[1])) {
    $method = $params[1];
    if (!method_exists($controllerName, $method)) {
        error(404, 'Method not found');
        exit;
    }
} else {
    $method = 'index';
}

$controller = new $controllerName();
echo $controller->$method();