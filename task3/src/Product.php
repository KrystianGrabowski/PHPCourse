<?php

namespace products;

use Money\Money;

class Product implements IProduct 
{
    private $price;
    private $name;

    function __construct($price, $money)
    {
        $this->price = $price;
        $this->money = $money;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
}

?>