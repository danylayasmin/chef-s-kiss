<?php

include __DIR__ . '/vendor/autoload.php';

use RedBeanPHP\R as R;

//connect to database
R::setup('mysql:host=localhost;dbname=yff', 'bit_academy', 'bit_academy');

//empty table
R::wipe('recipes');

//create recipes
$recepten = [
    [
        'id' => 1,
        'name' => 'Appeltaart',
        'type' => 'Dessert',
        'level' => 'Medium',
    ],
    [
        'id' => 5,
        'name' => 'Gado gado',
        'type' => 'Diner',
        'level' => 'Medium',
    ],
    [
        'id' => 6,
        'name' => 'Monchoutaart',
        'type' => 'Dessert',
        'level' => 'Easy',
    ],
    [
        'id' => 24,
        'name' => 'Pindasaus',
        'type' => 'Bijgerecht',
        'level' => 'Easy',
    ],
    [
        'id' => 36,
        'name' => 'Pastasalade',
        'type' => 'Diner',
        'level' => 'Easy',
    ],
    [
        'id' => 47,
        'name' => 'Bloemkoolschotel',
        'type' => 'Diner',
        'level' => 'Medium',
    ],
];


//insert recipes
foreach ($recepten as $recept) {
    $recipes = R::dispense('recipes');
    $recipes->name = $recept['name'];
    $recipes->type = $recept['type'];
    $recipes->level = $recept['level'];
    R::store($recipes);
}