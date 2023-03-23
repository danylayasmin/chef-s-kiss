<?php

use RedBeanPHP\R as R;

class RecipeController extends BaseController
{
    public function index()
    {
        $recipes = R::getAll('SELECT * FROM recipes');
        $data = [
            'recipes' => $recipes,
        ];

        displayTemplate('recipes/index.twig', $data);
    }    
   
    public function show()
    {
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided');
            exit;
        }
        $recipe = $this->getBeanById('recipes', $_GET['id']);
        if (!isset($recipe)) {
            error(404, 'Recipe not found with ID ' . $_GET['id']);
            exit;
        }
        $data = [
            'recipe' => $recipe,
            'id' => $_GET['id'],
        ];
        displayTemplate('recipes/show.twig', $data);
    }
}