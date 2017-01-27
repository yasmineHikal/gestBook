<?php
session_start();
require('../includes/config.php');
require('../includes/products.class.php');
require('../includes/general.functions.php');

if(!checkLogin())
    exit('you are not allowed to view this page');

$idFromUrl = (isset($_GET['id']))? (int)$_GET['id'] : 0;

$error = '';
$success = '';

$productsObject = new products();
$product = $productsObject->getProduct($idFromUrl);

include('../templates/admin/header.html');
include('../templates/admin/menu.html');
//product found
if(count($_POST)>0)
{
    //update product

    $idFromForm  = $_POST['id'];
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $available   = $_POST['available'];

    $productImage = $product['image'];

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
            $newImageName = md5($name.date('U').rand(1000,100000)).$name;
            //move
            if(move_uploaded_file($temp,'../uploads/'.$newImageName))
            {
                if(file_exists('../uploads/'.$productImage))
                    unlink('../uploads/'.$productImage);

                $productImage = $newImageName;
            }
        }

    }

    if($productsObject->updateProduct($idFromForm,$title,$description,$productImage,$price,$available))
    {

        $success = 'product Updated successfully';
        include('../templates/admin/resultmessage.html');
    }
    else
    {
        $error = 'Invalid data submitted';
        include('../templates/admin/resultmessage.html');
    }


}
else
{

    if(!$product || count($product)==0)
    {
        $error = 'Product Not Found';
        include('../templates/admin/resultmessage.html');
        include('../templates/admin/footer.html');
        exit;
    }

    //show product in form
    include('../templates/admin/updateproduct.html');
}
include('../templates/admin/footer.html'); ?>

