<?php

use RedBeanPHP\R as R;

class CuisineController extends BaseController
{
    // show all cuisines
    public function index()
    {
        $cuisines = R::getAll('SELECT * FROM cuisine');

        // get data for template
        $data = [
        'cuisines' => $cuisines,
        ];
    
        displayTemplate('cuisines/index.twig', $data);
    }

    // show cuisine with specific id
    public function show()
    {
        // check if id is set
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided', '/cuisine/show');
            exit;
        }

        // check if id cuisine exists
        $cuisine = $this->getBeanById('cuisine', $_GET['id']);
        if (!isset($cuisine)) {
            error(404, 'Cuisine not found with ID ' . $_GET['id'], '/cuisine/show');
            exit;
        }

        // get all recipes from cuisine
        $recipes = [];
        foreach ($cuisine->ownRecipeList as $recipe) {
            $recipes[] = $recipe;
        }
 
        // get data for template
        $data = [
            'cuisine' => $cuisine,
            'recipes' => $recipes,
            'id' => $_GET['id'],
        ];
        
        displayTemplate('cuisines/show.twig', $data);
    }

    // create new cuisine
    public function create()
    {
        // check if user is logged in
        $this->authorizeUser();

        displayTemplate('cuisines/create.twig', []);
    }

    // store new cuisine in database
    public function createPost()
    {
        // store data in database
        $cuisine = R::dispense('cuisine');
        $cuisine->name = $_POST['name'];
        $cuisine->description = $_POST['description'];
        R::store($cuisine);

        // redirect to new cuisine
        $id = $cuisine->id;
        header("Location: /cuisine/show?id=$id");
    }

    // edit cuisine with specific id
    public function edit()
    {
        // check if user is logged in
        $this->authorizeUser();
        
        // check if id is set
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided', '/cuisine/show');
            exit;
        }
        
        // check if id cuisine exists
        $cuisine = $this->getBeanById('cuisine', $_GET['id']);
        if (!isset($cuisine)) {
            error(404, 'Cuisine not found with ID ' . $_GET['id'], '/cuisine/show');
            exit;
        }

        // get data for template
        $data = [
            'cuisine' => $cuisine,
            'id' => $_GET['id']
        ];
        displayTemplate('cuisines/edit.twig', $data);
    }

    // update cuisine in database
    public function editPost()
    {
        // store changed data in database
        $cuisine = R::load('cuisine', $_POST['id']);
        $cuisine->name = $_POST['name'];
        $cuisine->description = $_POST['description'];
        R::store($cuisine);

        // redirect to edited cuisine
        $id = $_POST['id'];
        header("Location: /cuisine/show?id=$id");
    }
}