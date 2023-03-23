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
}