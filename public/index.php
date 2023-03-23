<?php

require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);

$data = [
    'name' => 'Da',
    'fruits' => ['appel', 'peulvrucht'],
];

displayTemplate('welcome.twig', $data);
