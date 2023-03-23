<?php

class RecipeController
{
    protected $recipes = [
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

    public function index()
    {
        $data = [
        'recipes' => $this->recipes,
        ];

        displayTemplate('recipes/index.twig', $data);
    }    
   
    public function show()
    {
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided');
            exit;
        }
        
        foreach ($this->recipes as $recipe) {
            if ($recipe['id'] == $_GET['id']) {
                $data = [
                    'recipe' => $recipe,
                ];

                displayTemplate('recipes/show.twig', $data);
                exit;
            }
        }
        
        if (!isset($this->recipes[$_GET['id'] - 1])) {
            error(404, 'Recipe not found with ID ' . $_GET['id']);
            exit;
        }
    }
}