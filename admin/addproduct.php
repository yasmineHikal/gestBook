<?php
session_start();
require('../includes/config.php');
require('../includes/products.class.php');
require('../includes/general.functions.php');

if(!checkLogin())
    exit('you are not allowed to view this page');

$error = '';
$success = '';

if(count($_POST)>0)
{
    $productsObject = new products();

    $title       = $_POST['title'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $available   = $_POST['available'];
    $userId      = $_SESSION['user']['id'];
    //
    $image = '';
    if(isset($_FILES['image']))
    {
        //info
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $temp = $_FILES['image']['tmp_name'];
        $uploadError = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];


        if(($type == 'image/png' || $type=='image/jpg' || $type=='image/jpeg') && $uploadError == 0 )
        {
            //rename :
            $image = md5($name.date('U').rand(1000,100000)).$name;
            //move
            move_uploaded_file($temp,'../uploads/'.$image);
        }

    }


    if($productsObject->addProduct($title,$description,$image,$price,$available,$userId))
        $success = 'product added successfully';
    else
        $error = 'Invalid data submitted';

}

include('../templates/admin/header.html');
include('../templates/admin/menu.html');
include('../templates/admin/add-product.html');
include('../templates/admin/footer.html');