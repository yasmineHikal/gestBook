<?php

class products
{
    private $connection;

    /**
     * create connection
     */
    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }


    /**
     * add new product
     * @param $title
     * @param $description
     * @param $image
     * @param $price
     * @param $available
     * @param $userId
     * @return bool
     */
    public function addProduct($title,$description,$image,$price,$available,$userId)
    {
        $this->connection->query("INSERT INTO `products`(`title`, `description`, `image`, `price`, `available`, `user_id`) VALUES ('$title','$description','$image',$price,$available,$userId)");

        if($this->connection->affected_rows>0)
            return true;

        echo $this->connection->error;
        return false;
    }


    /**
     * update product
     * @param $id
     * @param $title
     * @param $description
     * @param $image
     * @param $price
     * @param $available
     * @return bool
     */
    public function updateProduct($id,$title,$description,$image,$price,$available)
    {
        $this->connection->query("UPDATE `products` SET `title`='$title',`description`='$description',`image`='$image',`price`=$price,`available`=$available WHERE `id`=$id");

        if($this->connection->affected_rows>0)
            return true;

        echo $this->connection->error;
        return false;
    }


/**
     * delete product
     * @param $id
     * @return bool
     */
    public function deleteProduct($id)
    {
        $this->connection->query("DELETE FROM `products` WHERE `id`=$id");

        if($this->connection->affected_rows>0)
            return true;

        return false;
    }


    /**
     * get all products
     * @return array|null
     */
    public function getProducts($extra='')
    {
        $result = $this->connection->query("SELECT * FROM `products` $extra");

        if($result->num_rows>0)
        {
            $products = array();

            while($row = $result->fetch_assoc())
            {
                $products[] = $row;
            }
            return $products;
        }

        return null;
    }


    /**
     * get product by id
     * @param $id
     * @return null
     */
    public function getProduct($id)
    {
        $products = $this->getProducts("WHERE `id`=$id");

        if($products && count($products)>0)
            return $products[0];

        return null;
    }


    /**
     * close connection
     */
    public function __destruct()
    {
        $this->connection->close();
    }
}