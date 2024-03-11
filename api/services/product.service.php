<?php

class Product
{
    private string $name;
    private string $description;
    private int $likes;
    private int $price;

    public function __construct(string $name, string $description, int $likes, int $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->likes = $likes;
        $this->price = $price;
    }

    private static $table_name = 'products';

    public static function getAll()
    {
        try {
            // query from database
            require_once $_SERVER['DOCUMENT_ROOT'] . '/shop/includes/database.inc.php';

            $query = 'SELECT id,name,description,likes,price FROM ' . self::$table_name;
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            // fetch every result from statement
            $result = $stmt->fetchAll();

            // send results back
            return $result;
        } catch (Exception $e) {
            throw Errorresponse::internal_server_error;
        }
    }
    public static function remove(int $id)
    {
        try {
            // delete item in mysql
            require_once $_SERVER['DOCUMENT_ROOT'] . '/shop/includes/database.inc.php';

            $query = 'DELETE FROM' . self::$table_name . 'WHERE id = :p_id';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':p_id', $id);
            $stmt->execute();

            // return true for succeess
            return true;
        } catch (PDOException $e) {
            throw ErrorResponse::internal_server_error;
        }
    }
    public static function insert(Product $product)
    {
        try {
            // insert data into database
            require_once $_SERVER['DOCUMENT_ROOT'] . '/shop/includes/database.inc.php';

            $query = 'INSERT INTO' . self::$table_name . '(name, description, likes, price) VALUES (:name, :description, :likes, :price)';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':name', $product->getName());
            $stmt->bindParam(':description', $product->getDescription());
            $stmt->bindParam(':likes', $product->getLikes());
            $stmt->bindParam(':price', $product->getPrice());
            $stmt->execute();

            // retrun true for success
            return true;
        } catch (Exception $e) {
            throw ErrorResponse::internal_server_error;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function getLikes(): int
    {
        return $this->likes;
    }
    public function getPrice(): int
    {
        return $this->price;
    }
}
?>