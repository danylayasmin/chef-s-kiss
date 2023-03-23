<?php

class KitchenController
{
    protected $kitchens = [
        [
            'id' => 1,
            'name' => 'Franse keuken',
            'description' => 'De Franse keuken is een internationaal gewaardeerde keuken met een lange traditie. Deze 
                keuken wordt gekenmerkt door een zeer grote diversiteit, zoals dat ook wel gezien wordt in de Chinese 
                keuken en Indische keuken.',
        ],
        [
            'id' => 2,
            'name' => 'Chineese keuken',
            'description' => 'De Chinese keuken is de culinaire traditie van China en de Chinesen die in de diaspora 
                leven, hoofdzakelijk in Zuid-Oost-Azië. Door de grootte van China en de aanwezigheid van vele volkeren met 
                eigen culturen, door klimatologische afhankelijkheden en regionale voedselbronnen zijn de variaties groot.',
        ],
        [
            'id' => 3,
            'name' => 'Hollandse keuken',
            'description' => 'De Nederlandse keuken is met name geïnspireerd door het landbouwverleden van Nederland.
                 Alhoewel de keuken per streek kan verschillen en er regionale specialiteiten bestaan, zijn er voor 
                 Nederland typisch geachte gerechten. Nederlandse gerechten zijn vaak relatief eenvoudig en voedzaam, 
                 zoals pap, Goudse kaas, pannenkoek, snert en stamppot.',
        ],
        [
            'id' => 4,
            'name' => 'Mediterrane keuken',
            'description' => 'De mediterrane keuken is de keuken van het Middellandse Zeegebied en bestaat onder 
                andere uit de tientallen verschillende keukens uit Marokko,Tunesie, Spanje, Italië, Albanië en Griekenland 
                en een deel van het zuiden van Frankrijk (zoals de Provençaalse keuken en de keuken van Roussillon).',
        ],
    ];

    public function index()
    {
        $data = [
            'kitchens' => $this->kitchens,
            ];
    
            displayTemplate('kitchens/index.twig', $data);
    }

    public function show()
    {
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided');
            exit;
        }

        if (!isset($this->kitchens[$_GET['id'] - 1])) {
            error(404, 'kitchen not found with ID ' . $_GET['id']);
            exit;
        }

        foreach ($this->kitchens as $kitchen) {
            if ($kitchen['id'] == $_GET['id']) {
                $id = $_GET['id'] - 1;
                $kitchen = $this->kitchens[$id];

                $data = [
                    'kitchen' => $kitchen,
                ];

                displayTemplate('kitchens/show.twig', $data);
            }
        }
    }
}