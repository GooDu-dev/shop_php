<?php

require_once 'config.php';

try {
    $pdo = new PDO('mysql:host=' . $_ENV['DATABASE_SERVER'] . ';dbname=' . $_ENV['DATABASE_NAME'], $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connect failed: ' . $e->getMessage();
}

?>