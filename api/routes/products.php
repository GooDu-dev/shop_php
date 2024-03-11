<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/shop/api/controllers/product.controller.php';

$path = '/shop/api/product';

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$product_routes = [
    $path => getAll()
];

?>