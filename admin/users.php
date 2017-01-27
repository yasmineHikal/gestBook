<?php
session_start();
require('../includes/config.php');
require('../includes/users.class.php');
require('../includes/general.functions.php');

if(!checkLogin())
    exit('you are not allowed to view this page');

//logged in
$userObject = new users();
$allusers = $userObject->getUsers();


include('../templates/admin/header.html');
include('../templates/admin/menu.html');
include('../templates/admin/all-users.html');
include('../templates/admin/footer.html');
