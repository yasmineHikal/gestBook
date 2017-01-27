<?php
session_start();

require('../includes/config.php');
require('../includes/messages.class.php');
require('../includes/general.functions.php');

if(!checkLogin())
    exit('you are not allowed to view this page');

$gbObject = new messages();

$idFromUrl = (isset($_GET['id']))? (int)$_GET['id'] : 0;
$error = '';
$success = '';

include('../templates/admin/header.html');
include('../templates/admin/menu.html');
if(count($_POST)>0)
{
    $idFromForm = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if($gbObject->updateMessage($idFromForm,$title,$content))
    {
        $success = 'Message Updated Successfully';
    }
    else
    {
        $error = 'Message Not Updated';
    }

    include('../templates/admin/resultmessage.html');
    include('../templates/admin/footer.html');
    exit;

}
else
{
    $message = $gbObject->getMessage($idFromUrl);

    if(!$message || count($message) ==0)
    {
        $error = 'Message not found';
        include('../templates/admin/resultmessage.html');
        include('../templates/admin/footer.html');
        exit;
    }

    include('../templates/admin/updatemessage.html');

}

include('../templates/admin/footer.html');