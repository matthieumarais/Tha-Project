<?php

namespace App\Products;

use App\Products\Products;

class InfosCart
{
    private $id;
    private $price;
    private $description;

    public function __construct(array $item)
    {
        $this->id = $item['id'];
        $product = new Products;
        $infosProduct = $product->selectOneById($this->id);
        var_dump($infosProduct);
    }

    public function getId()
    {
        return $this->id;
    }
    public function price()
    {
        return $this->price;
    }
    public function description()
    {
        return $this->description;
    }
}