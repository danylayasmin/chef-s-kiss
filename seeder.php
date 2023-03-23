<?php

include __DIR__ . '/vendor/autoload.php';

use RedBeanPHP\R as R;

//connect to database
R::setup('mysql:host=localhost;dbname=yff', 'bit_academy', 'bit_academy');

//empty tables
R::wipe('recipes');
R::wipe('kitchens');

//create recipes
$recepten = [
    [
        'name' => 'Appeltaart',
        'type' => 'Dessert',
        'level' => 'Medium',
    ],
    [
        'name' => 'Gado gado',
        'type' => 'Dinner',
        'level' => 'Medium',
    ],
    [
        'name' => 'Monchoutaart',
        'type' => 'Dessert',
        'level' => 'Easy',
    ],
    [
        'name' => 'Pindasaus',
        'type' => 'Side dish',
        'level' => 'Easy',
    ],
    [
        'name' => 'Pastasalade',
        'type' => 'Dinner',
        'level' => 'Easy',
    ],
    [
        'name' => 'Bloemkoolschotel',
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
        'name' => 'Chineese keuken',
        'description' => 'De Chinese keuken is de culinaire traditie van China en de Chinesen die in de diaspora 
            leven, hoofdzakelijk in Zuid-Oost-Azië. Door de grootte van China en de aanwezigheid van vele volkeren met 
            eigen culturen, door klimatologische afhankelijkheden en regionale voedselbronnen zijn de variaties groot.',
    ],
    [
        'name' => 'Hollandse keuken',
        'description' => 'De Nederlandse keuken is met name geïnspireerd door het landbouwverleden van Nederland.
             Alhoewel de keuken per streek kan verschillen en er regionale specialiteiten bestaan, zijn er voor 
             Nederland typisch geachte gerechten. Nederlandse gerechten zijn vaak relatief eenvoudig en voedzaam, 
             zoals pap, Goudse kaas, pannenkoek, snert en stamppot.',
    ],
    [
        'name' => 'Mediterrane keuken',
        'description' => 'De mediterrane keuken is de keuken van het Middellandse Zeegebied en bestaat onder 
            andere uit de tientallen verschillende keukens uit Marokko,Tunesie, Spanje, Italië, Albanië en Griekenland 
            en een deel van het zuiden van Frankrijk (zoals de Provençaalse keuken en de keuken van Roussillon).',
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
print(R::count('recipes') . " recipes inserted" . PHP_EOL);

//insert kitchens
foreach ($keukens as $keuken) {
    $kitchens = R::dispense('kitchens');
    $kitchens->name = $keuken['name'];
    $kitchens->description = $keuken['description'];
    R::store($kitchens);
}
print(R::count('kitchens') . " kitchens inserted");
