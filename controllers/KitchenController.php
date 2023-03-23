<?php

use RedBeanPHP\R as R;

class KitchenController extends BaseController
{
    public function index()
    {
        $kitchens = R::getAll('SELECT * FROM kitchens');

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
        $kitchen = $this->getBeanById('kitchens', $_GET['id']);
        if (!isset($kitchen)) {
            error(404, 'kitchen not found with ID ' . $_GET['id']);
            exit;
        }

            $data = [
                'kitchen' => $kitchen,
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
        $kitchen = R::dispense('kitchens');
        $kitchen->name = $_POST['name'];
        $kitchen->description = $_POST['description'];
        R::store($kitchen);

        // redirect to new kitchen
        $id = $kitchen->id;
        header("Location: http://localhost/kitchen/show?id=$id");
    }
}