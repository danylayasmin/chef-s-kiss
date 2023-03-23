<?php

use RedBeanPHP\R as R;

class KitchenController extends BaseController
{
    public function index()
    {
        $kitchens = R::getAll('SELECT * FROM kitchen');

        $data = [
        'kitchens' => $kitchens,
        ];
    
        displayTemplate('kitchens/index.twig', $data);
    }

    public function show()
    {
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided');
            exit;
        }
        $kitchen = $this->getBeanById('kitchen', $_GET['id']);
        if (!isset($kitchen)) {
            error(404, 'Kitchen not found with ID ' . $_GET['id']);
            exit;
        }

        $recipes = [];
        foreach ($kitchen->ownRecipeList as $recipe) {
            $recipes[] = $recipe;
        }
 
        $data = [
            'kitchen' => $kitchen,
            'recipes' => $recipes,
            'id' => $_GET['id'],
        ];

        displayTemplate('kitchens/show.twig', $data);
    }

    public function create()
    {
        displayTemplate('kitchens/create.twig', []);
    }

    public function createPost()
    {
        // store data in database
        $kitchen = R::dispense('kitchen');
        $kitchen->name = $_POST['name'];
        $kitchen->description = $_POST['description'];
        R::store($kitchen);

        // redirect to new kitchen
        $id = $kitchen->id;
        header("Location: http://localhost/kitchen/show?id=$id");
    }

    public function edit()
    {
        if (!isset($_GET['id'])) {
            error(404, 'No ID provided');
            exit;
        }
        $kitchen = $this->getBeanById('kitchen', $_GET['id']);
        if (!isset($kitchen)) {
            error(404, 'Kitchen not found with ID ' . $_GET['id']);
            exit;
        }
        $data = [
            'kitchen' => $kitchen,
            'id' => $_GET['id']
        ];
        displayTemplate('kitchens/edit.twig', $data);
    }

    public function editPost()
    {
        $kitchen = R::load('kitchen', $_POST['id']);
        $kitchen->name = $_POST['name'];
        $kitchen->description = $_POST['description'];
        R::store($kitchen);

        // redirect to edited kitchen
        $id = $_POST['id'];
        header("Location: http://localhost/kitchen/show?id=$id");
    }
}