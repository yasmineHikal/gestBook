<?php
session_start();
require('../includes/config.php');
require('../includes/messages.class.php');
require('../includes/general.functions.php');

if(!checkLogin())
    exit('you are not allowed to view this page');

$id = (isset($_GET['id']))? (int)$_GET['id'] : 0;

$error = '';
$success = '';

$gbObject = new messages();

include('../templates/admin/header.html');
include('../templates/admin/menu.html');
if($gbObject->deleteMessage($id))
{
    $success = 'Message deleted Successfully';
}
else
{
    $error ='Message Not Deleted';
}

include('../templates/admin/resultmessage.html');
include('../templates/admin/footer.html');

