<?php

use RedBeanPHP\R as R;

class UserController extends BaseController
{
    public function login()
    {
        if (isset($_SESSION['loggedInUser'])) {
            error(303, 'You are already logged in', '/');
            exit;
        }

        displayTemplate('users/login.twig', []);
    }
    
    public function loginPost()
    {
        $user = R::findOne('user', 'username = ?', [$_POST['username']]);
        if (!isset($user)) {
            error(401, 'User not found with username ' . $_POST['username'], '/user/login');
        }
        if (!password_verify($_POST['password'], $user->password)) {
            error(401, 'Username and password do not match', '/user/login');
        }
        $_SESSION['loggedInUser'] = $user['id'];
        header("Location: /");
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
        die();
    }

    public function register()
    {
        if (isset($_SESSION['loggedInUser'])) {
            error(303, 'You are already logged in', '/');
            exit;
        }

        displayTemplate('users/register.twig', []);
    }

    public function registerPost() 
    {
        if ($_POST["password"] !== $_POST["confirmPassword"]) {
            error(401, 'Passwords do not match', '/user/register');
            die();
        }
        $user = R::findOne('user', 'username = ?', [$_POST['username']]);
        if (!is_null($user)) {
            error(401, 'Username already taken', '/user/register');
            die();
        }
        $user = R::dispense('user');
        $user->username = $_POST['username'];
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        R::store($user);
        $_SESSION['loggedInUser'] = $user['id'];
        header("Location: /");
    }
}