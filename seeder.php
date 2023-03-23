<?php

include __DIR__ . '/vendor/autoload.php';

use RedBeanPHP\R as R;

//connect to database
R::setup('mysql:host=localhost;dbname=yff', 'bit_academy', 'bit_academy');

//empty tables
R::nuke();

//create recipes
$recepten = [
    [
        'name' => 'Appeltaart',
        'kitchen' => 'Nederlandse keuken',
        'type' => 'Dessert',
        'level' => 'Medium',
    ],
    [
        'name' => 'Gado gado',
        'kitchen' => 'Indonesische keuken',
        'type' => 'Dinner',
        'level' => 'Medium',
    ],
    [
        'name' => 'Monchoutaart',
        'kitchen' => 'Franse keuken',
        'type' => 'Dessert',
        'level' => 'Easy',
    ],
    [
        'name' => 'Pindasaus',
        'kitchen' => 'Indonesische keuken',
        'type' => 'Side dish',
        'level' => 'Easy',
    ],
    [
        'name' => 'Pastasalade',
        'kitchen' => 'Nederlandse keuken',
        'type' => 'Dinner',
        'level' => 'Easy',
    ],
    [
        'name' => 'Bloemkoolschotel',
        'kitchen' => 'Nederlandse keuken',
        'type' => 'Dinner',
        'level' => 'Medium',
    ],
];

// create kitchens
$keukens = [
    [
        'name' => 'Franse keuken',
        'description' => 'De Franse keuken is een internationaal gewaardeerde keuken met een lange traditie. Deze 
            keuken wordt gekenmerkt door een zeer grote diversiteit, zoals dat ook wel gezien wordt in de Chinese 
            keuken en Indische keuken.',
    ],
    [
        'name' => 'Chinese keuken',
        'description' => 'De Chinese keuken is de culinaire traditie van China en de Chinezen die in de diaspora 
            leven, hoofdzakelijk in Zuid-Oost-Azië. Door de grootte van China en de aanwezigheid van vele volkeren met 
            eigen culturen, door klimatologische afhankelijkheden en regionale voedselbronnen zijn de variaties groot.',
    ],
    [
        'name' => 'Nederlandse keuken',
        'description' => 'De Nederlandse keuken is met name geïnspireerd door het landbouwverleden van Nederland.
             Alhoewel de keuken per streek kan verschillen en er regionale specialiteiten bestaan, zijn er voor 
             Nederland typisch geachte gerechten. Nederlandse gerechten zijn vaak relatief eenvoudig en voedzaam, 
             zoals pap, Goudse kaas, pannenkoek, snert en stamppot.',
    ],
    [
        'name' => 'Mediterrane keuken',
        'description' => 'De mediterrane keuken is de keuken van het Middellandse Zeegebied en bestaat onder 
            andere uit de tientallen verschillende keukens uit Marokko, Tunesië, Spanje, Italië, Albanië, Griekenland 
            en een deel van het zuiden van Frankrijk (zoals de Provençaalse keuken en de keuken van Roussillon).',
    ],
    [
        'name' => 'Indonesische keuken',
        'description' => 'De Indonesische keuken is de authentieke keuken van Indonesië. Deze keuken is zeer
            divers, omdat de honderden eilanden van de archipel op culinair gebied verschillen.  Veel
            eilanden kennen hun eigen recepten, die met specifieke kruiden worden bereid.',
    ],
];

//create user
$gebruikers = [
    ['username' => 'john',
    'password' => password_hash('doe123', PASSWORD_BCRYPT),],
];

//insert kitchens
foreach ($keukens as $keuken) {
    $kitchen = R::dispense('kitchen');
    $kitchen->name = $keuken['name'];
    $kitchen->description = $keuken['description'];
    R::store($kitchen);
}
print(R::count('kitchen') . " kitchens inserted" . PHP_EOL);

//insert recipes
foreach ($recepten as $recept) {
    $recipe = R::dispense('recipe');
    $recipe->name = $recept['name'];
    $recipe->type = $recept['type'];
    $recipe->level = $recept['level'];

    $kitchen = R::findOne('kitchen', 'name = ?', [$recept['kitchen']]);
    $recipe->kitchen = $kitchen;
    
    R::store($recipe);
}
print(R::count('recipe') . " recipes inserted" . PHP_EOL);

//insert user
foreach ($gebruikers as $gebruiker) {
    $user = R::dispense('user');
    $user->username = $gebruiker['username'];
    $user->password = $gebruiker['password'];
    R::store($user);
}
print(R::count('user') . " users inserted" . PHP_EOL);