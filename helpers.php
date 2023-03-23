<?php

function displayTemplate($template, $data)
{
    global $twig;
    echo $twig->render($template, $data);
}

function error($errorNumber, $errorMessage)
{
    $error = 'Error ' . $errorNumber . ': ' . $errorMessage;
    http_response_code($errorNumber);
    displayTemplate('error.twig', ['errorMessage' => $errorMessage, 'errorNumber' => $errorNumber]);
    die();
}
