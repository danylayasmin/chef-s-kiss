<?php

use RedBeanPHP\R as R;

class KitchenController extends BaseController
{
    // show all kitchens
    public function index()
    {
        $kitchens = R::getAll('SELECT * FROM kitchen');

        // get data for template
        $data = [
        'kitchens' => $kitchens,
        ];
    
        displayTemplate('kitchens/index.twig', $data);
    }

    // show kitchen with specific id
    public function show()
    {
        // check if id is set
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided', '/kitchen/show');
            exit;
        }

        // check if id kitchen exists
        $kitchen = $this->getBeanById('kitchen', $_GET['id']);
        if (!isset($kitchen)) {
            error(404, 'Kitchen not found with ID ' . $_GET['id'], '/kitchen/show');
            exit;
        }

        // get all recipes from kitchen
        $recipes = [];
        foreach ($kitchen->ownRecipeList as $recipe) {
            $recipes[] = $recipe;
        }
 
        // get data for template
        $data = [
            'kitchen' => $kitchen,
            'recipes' => $recipes,
            'id' => $_GET['id'],
        ];
        
        displayTemplate('kitchens/show.twig', $data);
    }

    // create new kitchen
    public function create()
    {
        // check if user is logged in
        $this->authorizeUser();

        displayTemplate('kitchens/create.twig', []);
    }

    // store new kitchen in database
    public function createPost()
    {
        // store data in database
        $kitchen = R::dispense('kitchen');
        $kitchen->name = $_POST['name'];
        $kitchen->description = $_POST['description'];
        R::store($kitchen);

        // redirect to new kitchen
        $id = $kitchen->id;
        header("Location: /kitchen/show?id=$id");
    }

    // edit kitchen with specific id
    public function edit()
    {
        // check if user is logged in
        $this->authorizeUser();
        
        // check if id is set
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided', '/kitchen/show');
            exit;
        }
        
        // check if id kitchen exists
        $kitchen = $this->getBeanById('kitchen', $_GET['id']);
        if (!isset($kitchen)) {
            error(404, 'Kitchen not found with ID ' . $_GET['id'], '/kitchen/show');
            exit;
        }

        // get data for template
        $data = [
            'kitchen' => $kitchen,
            'id' => $_GET['id']
        ];
        displayTemplate('kitchens/edit.twig', $data);
    }

    // update kitchen in database
    public function editPost()
    {
        // store changed data in database
        $kitchen = R::load('kitchen', $_POST['id']);
        $kitchen->name = $_POST['name'];
        $kitchen->description = $_POST['description'];
        R::store($kitchen);

        // redirect to edited kitchen
        $id = $_POST['id'];
        header("Location: /kitchen/show?id=$id");
    }
}