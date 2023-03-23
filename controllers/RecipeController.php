<?php

use RedBeanPHP\R as R;

class RecipeController extends BaseController
{
    // show all recipes
    public function index()
    {
        $recipes = R::getAll('SELECT * FROM recipe');

        // get data for template
        $data = [
            'recipes' => $recipes,
        ];

        displayTemplate('recipes/index.twig', $data);
    }    
   
    // show recipe with specific id
    public function show()
    {
        // check if id is set
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided', '/recipe/show');
            exit;
        }

        // check if id recipe exists
        $recipe = $this->getBeanById('recipe', $_GET['id']);
        if (!isset($recipe)) {
            error(404, 'Recipe not found with ID ' . $_GET['id'], '/recipe/show');
            exit;
        }

        // get data for template
        $data = [
            'kitchen' => $recipe->kitchen,
            'recipe' => $recipe,
            'id' => $_GET['id'],
        ];
        displayTemplate('recipes/show.twig', $data);
    }

    // create new recipe
    public function create()
    {
        // check if user is logged in
        $this->authorizeUser();
        
        // get data for template
        $const = array(
            'kitchens' => R::getCol('SELECT name FROM kitchen'),
            'types' => ['Breakfast', 'Lunch', 'Dinner', 'Dessert', 'Side dish'],
            'levels' => ['Easy', 'Medium', 'Hard']          
        );
        
        displayTemplate('recipes/create.twig', $const);
    }

    // store new recipe in database
    public function createPost()
    {
        // find kitchen with name from form
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
        header("Location: /kitchen/show?id=$id");
    }

    // edit recipe with specific id
    public function edit()
    {
        // check if user is logged in
        $this->authorizeUser();
        
        // check if id is set
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided', '/recipe/show');
            exit;
        }

        // check if id recipe exists
        $recipe = $this->getBeanById('recipe', $_GET['id']);
        if (!isset($recipe)) {
            error(404, 'Recipe not found with ID ' . $_GET['id'], '/recipe/show');
            exit;
        }

        // get data for template
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

    // update recipe in database
    public function editPost()
    {
        // store data in database
        $recipe = R::load('recipe', $_POST['id']);
        $recipe->name = $_POST['name'];
        $recipe->type = $_POST['type'];
        $recipe->level = $_POST['level'];
        
        // find kitchen with name from form and set it to recipe
        $kitchen = R::findOne('kitchen', 'name = ?', [$_POST['kitchen']]);
        $recipe->kitchen = $kitchen;
        R::store($recipe);

        // redirect to edited recipe
        $id = $_POST['id'];
        header("Location: /recipe/show?id=$id");
    }
}