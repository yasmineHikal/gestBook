<?php
include('includes/config.php');
include('includes/products.class.php');
$selected = 'home';

$productsObject = new products();
$products = $productsObject->getProducts("ORDER BY `id` DESC LIMIT 3");

include('templates/front/header.html');
include('templates/front/index.html');
include('templates/front/footer.html');