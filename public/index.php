<?php

require_once '../vendor/autoload.php';
require_once '../controllers/RecipeController.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);

$data = [
    'name' => 'Da',
    'fruits' => ['appel', 'peulvrucht'],
];

displayTemplate('welcome.twig', $data);

$controller = new RecipeController();

// method checken -> default
if (isset($_GET['method'])) {
    $method = $_GET['method'];
} else {
    $method = 'index';
}

echo $controller->$method();