<?php

define('PATH', '/shop/api');

$url = parse_url($_SERVER["REQUEST_URI"])['path'];
require_once './api/routes/products.php';

$routes = [
    PATH => ''
];

$routes = array_merge($routes, $product_routes);

$url = parse_url('http://localhost:80/shop/api/product')['path'];

if (array_key_exists($url, $routes)) {
    print_r(json_encode(['url' => $url, 'routes' => $routes, 'is_exist' => array_key_exists($url, $routes)]));
    // echo $routes[$url];
} else {
    // print_r(json_encode(['url' => $url, 'route' => $routes, 'is_exist' => array_key_exists($url, $routes)]));
    http_response_code(404);
    echo json_encode(['message' => 'Page not found.']);
}

?>