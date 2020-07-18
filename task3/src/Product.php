<?php

namespace src;

use Money\Money;

class Product implements IProduct 
{
    private $price;
    private $name;

    function __construct(Money $price, string $name)
    {
        $this->price = $price;
        $this->name = $name;
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