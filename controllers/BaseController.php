<?php

use RedBeanPHP\R as R;

class BaseController
{
    public function getBeanById($typeOfBean, $queryStringKey)
    {
        $bean = R::findOne($typeOfBean, 'id = ?', [$queryStringKey]);
        return $bean;
    }

    public function authorizeUser()
    {
        if (!isset($_SESSION['loggedInUser'])) {
            header('Location: /user/login');
            die();
        }
    }
}