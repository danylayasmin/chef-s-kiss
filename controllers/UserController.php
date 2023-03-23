<?php

use RedBeanPHP\R as R;

class UserController extends BaseController
{
    public function login()
    {
        if (isset($_SESSION['loggedInUser'])) {
            error(303, 'You are already logged in', 'http://localhost/');
            exit;
        }

        displayTemplate('users/login.twig', []);
    }
    
    public function loginPost()
    {
        $user = R::findOne('user', 'username = ?', [$_POST['username']]);
        if (!isset($user)) {
            error(401, 'User not found with username ' . $_POST['username'], 'http://localhost/user/login');
        }
        if (!password_verify($_POST['password'], $user->password)) {
            error(401, 'Username and password do not match', 'http://localhost/user/login');
        }
        $_SESSION['loggedInUser'] = $user['id'];
        header("Location: http://localhost/");
    }

    public function logout()
    {
        session_destroy();
        header("Location: http://localhost/");
        die();
    }
}
