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
            'cuisine' => $recipe->cuisine,
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
            'cuisines' => R::getCol('SELECT name FROM cuisine'),
            'types' => ['Breakfast', 'Lunch', 'Dinner', 'Dessert', 'Side dish'],
            'difficulties' => ['Easy', 'Medium', 'Hard']          
        );
        
        displayTemplate('recipes/create.twig', $const);
    }

    // store new recipe in database
    public function createPost()
    {
        // find cuisine with name from form
        $cuisine = R::findOne('cuisine', 'name = ?', [$_POST['cuisine']]);
        
        // store data in database
        $recipe = R::dispense('recipe');
        $recipe->name = $_POST['name'];
        $recipe->cuisine = $cuisine;
        $recipe->type = $_POST['type'];
        $recipe->difficulty = $_POST['difficulty'];
        R::store($recipe);

        // redirect to cuisine belonging to recipe
        $id = $recipe->cuisine->id;
        header("Location: /cuisine/show?id=$id");
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
            'cuisine' => $recipe->cuisine,
            'cuisines' => R::getCol('SELECT name FROM cuisine'),
            'types' => ['Breakfast', 'Lunch', 'Dinner', 'Dessert', 'Side dish'],
            'difficulties' => ['Easy', 'Medium', 'Hard']
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
        $recipe->difficulty = $_POST['difficulty'];
        
        // find cuisine with name from form and set it to recipe
        $cuisine = R::findOne('cuisine', 'name = ?', [$_POST['cuisine']]);
        $recipe->cuisine = $cuisine;
        R::store($recipe);

        // redirect to edited recipe
        $id = $_POST['id'];
        header("Location: /recipe/show?id=$id");
    }
}
