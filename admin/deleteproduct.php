<?php
session_start();
require('../includes/config.php');
require('../includes/products.class.php');
require('../includes/general.functions.php');

if(!checkLogin())
    exit('you are not allowed to view this page');

$id = (isset($_GET['id']))? (int)$_GET['id'] : 0;


$error = '';
$success = '';

$productsObject = new products();
$product = $productsObject->getProduct($id);

include('../templates/admin/header.html');
include('../templates/admin/menu.html');
if($productsObject->deleteProduct($id))
{
    if(file_exists('../uploads/'.$product['image']))
        unlink('../uploads/'.$product['image']);
    $success = 'Product deleted';
}
else
{
    $error = 'Product Not Deleted';
}

include('../templates/admin/resultmessage.html');
include('../templates/admin/footer.html');