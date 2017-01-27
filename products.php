<?php
include('includes/config.php');
include('includes/products.class.php');

$selected = 'products';
$productsObject = new products();
$products = $productsObject->getProducts('ORDER BY `id` DESC');

include('templates/front/header.html');
include('templates/front/products.html');
include('templates/front/footer.html');