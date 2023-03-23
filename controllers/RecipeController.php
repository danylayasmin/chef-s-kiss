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
            'id' => 2,
            'name' => 'Pindasaus',
            'type' => 'Bijgerecht',
            'level' => 'Easy',
        ],
        [
            'id' => 3,
            'name' => 'Pastasalade',
            'type' => 'Diner',
            'level' => 'Easy',
        ],
        [
            'id' => 4,
            'name' => 'Bloemkoolschotel',
            'type' => 'Diner',
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
        echo "Hello from show";
    }
}