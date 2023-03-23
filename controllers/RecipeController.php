<?php

use RedBeanPHP\R as R;

class RecipeController extends BaseController
{
    public function index()
    {
        $recipes = R::getAll('SELECT * FROM recipe');
        $data = [
            'recipes' => $recipes,
        ];

        displayTemplate('recipes/index.twig', $data);
    }    
   
    public function show()
    {
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided', 'http://localhost/recipe/show');
            exit;
        }
        $recipe = $this->getBeanById('recipe', $_GET['id']);
        if (!isset($recipe)) {
            error(404, 'Recipe not found with ID ' . $_GET['id'], 'http://localhost/recipe/show');
            exit;
        }

        $data = [
            'kitchen' => $recipe->kitchen,
            'recipe' => $recipe,
            'id' => $_GET['id'],
        ];
        displayTemplate('recipes/show.twig', $data);
    }

    public function create()
    {
        $const = array(
            'kitchens' => R::getCol('SELECT name FROM kitchen'),
            'types' => ['Breakfast', 'Lunch', 'Dinner', 'Dessert', 'Side dish'],
            'levels' => ['Easy', 'Medium', 'Hard']          
        );
        
        displayTemplate('recipes/create.twig', $const);
    }

    public function createPost()
    {
        $kitchen = R::findOne('kitchen', 'name = ?', [$_POST['kitchen']]);
        // store data in database
        $recipe = R::dispense('recipe');
        $recipe->name = $_POST['name'];
        $recipe->kitchen = $kitchen;
        $recipe->type = $_POST['type'];
        $recipe->level = $_POST['level'];
        R::store($recipe);

        // redirect to kitchen belonging to recipe
        $id = $recipe->kitchen->id;
        header("Location: http://localhost/kitchen/show?id=$id");
    }

    public function edit()
    {
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided', 'http://localhost/recipe/show');
            exit;
        }
        $recipe = $this->getBeanById('recipe', $_GET['id']);
        if (!isset($recipe)) {
            error(404, 'Recipe not found with ID ' . $_GET['id'], 'http://localhost/recipe/show');
            exit;
        }
        $data = [
            'recipe' => $recipe,
            'id' => $_GET['id'],
            'kitchen' => $recipe->kitchen,
            'kitchens' => R::getCol('SELECT name FROM kitchen'),
            'types' => ['Breakfast', 'Lunch', 'Dinner', 'Dessert', 'Side dish'],
            'levels' => ['Easy', 'Medium', 'Hard']
        ];
        displayTemplate('recipes/edit.twig', $data);
    }

    public function editPost()
    {
        $recipe = R::load('recipe', $_POST['id']);
        $recipe->name = $_POST['name'];
        $recipe->type = $_POST['type'];
        $recipe->level = $_POST['level'];
        
        $kitchen = R::findOne('kitchen', 'name = ?', [$_POST['kitchen']]);
        $recipe->kitchen = $kitchen;
        R::store($recipe);

        // redirect to edited recipe
        $id = $_POST['id'];
        header("Location: http://localhost/recipe/show?id=$id");
    }
}