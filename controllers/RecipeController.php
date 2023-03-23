<?php

class RecipeController
{
    public function index()
    {
        $recipe = R::getAll('SELECT * FROM recipes');
        $data = [
            'recipes' => $recipe,
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