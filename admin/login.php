<?php
session_start();
require('../includes/config.php');
require('../includes/general.functions.php');
require('../includes/users.class.php');

if(checkLogin())
    exit('you are already logged in');


$error = '';
$success = '';

if(count($_POST)>0)
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $usersObject = new users();
    $userData    = $usersObject->login($username,$password);

    if($userData && count($userData)>0)
    {
        //store session
        $_SESSION['user'] = $userData;
        $success = 'login successful';
    }
    else
    {
        $error = 'Invalid username and password';
    }
}
include('../templates/admin/login.html');