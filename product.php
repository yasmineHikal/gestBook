<?php
include('includes/config.php');
include('includes/products.class.php');

$id = (isset($_GET['id']))? (int)$_GET['id']:0;
$selected = 'products';

include('templates/front/header.html');

$productsObject = new products();
$product = $productsObject->getProduct($id);

if($product && count($product)>0)
{
    include('templates/front/product-info.html');
}
else
{
    include('templates/front/404.html');
}
include('templates/front/footer.html');