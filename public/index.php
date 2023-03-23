<?php

require_once '../vendor/autoload.php';
require_once '../controllers/RecipeController.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);

displayTemplate('welcome.twig', []);

$controller = new RecipeController();

// method checken -> default
if (isset($_GET['method'])) {
    $method = $_GET['method'];
    if (!method_exists($controller, $method)) {
        error(404, 'Method not found');
        exit;
    }
} else {
    $method = 'index';
}

echo $controller->$method();