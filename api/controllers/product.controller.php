<?php

function getAll()
{

    // check request method == get -> passed
    if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        $error = ErrorResponse::bad_request;
        http_response_code($error->getStatus());
        return json_encode($error->getResponse());
    }

    // call getAll from products service
    require_once $_SERVER['DOCUMENT_ROOT'] . '/shop/api/services/product.service.php';
    $result = Product::getAll();

    // checking result is empty or not
    if (empty($result)) {
        $error = ErrorResponse::page_not_found;
        http_response_code($error->getStatus());
        return json_encode($error->getResponse());
    }

    // return result
    http_response_code(200);
    return json_encode($result);
}


?>