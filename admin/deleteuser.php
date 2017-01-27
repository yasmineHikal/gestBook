<?php
session_start();
require('../includes/config.php');
require('../includes/users.class.php');
require('../includes/general.functions.php');

if(!checkLogin())
    exit('you are not allowed to view this page');

$id = (isset($_GET['id']))? (int)$_GET['id'] : 0;

$usersObject = new users();
if($usersObject->deleteUser($id))
{
    header('LOCATION:users.php');
}
else
{
    echo 'Invalid user selected';
}