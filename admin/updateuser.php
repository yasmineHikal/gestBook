<?php
session_start();
require('../includes/config.php');
require('../includes/users.class.php');
require('../includes/general.functions.php');

if(!checkLogin())
    exit('you are not allowed to view this page');


$idFromUrl = (isset($_GET['id']))? (int)$_GET['id'] : 0;
$usersObject = new users();

$error = '';
$success = '';

if(count($_POST)>0)
{

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email    = $_POST['email'];
    $idFromForm = $_POST['id'];

    if($usersObject->updateUser($idFromForm,$username,$password,$email))
        $success = 'user updated';
    else
        $error = 'user not updated';


}
else
{
    //get user from db:
    $user =$usersObject->getUser($idFromUrl);

    //show user in from

}


include('../templates/admin/header.html');
include('../templates/admin/menu.html');
include('../templates/admin/update-user.html');
include('../templates/admin/footer.html');