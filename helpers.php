<?php

use RedBeanPHP\R as R;

function displayTemplate($template, $data = [])
{
    global $twig;
    $data['session'] = $_SESSION;
    $data['loggedInUser'] = $_SESSION['loggedInUser'] ?? null;
    $user = R::getAll('SELECT username FROM user WHERE id = ?', [$data['loggedInUser']]) ?? null;
    $data['username'] =  ($user[0]['username']) ?? null;
    echo $twig->render($template, $data);
}

function error($errorNumber, $errorMessage, $url)
{
    $error = 'Error ' . $errorNumber . ': ' . $errorMessage;
    http_response_code($errorNumber);
    displayTemplate('error.twig', ['errorMessage' => $errorMessage, 'errorNumber' => $errorNumber, 'url' => $url]);
    die();
}