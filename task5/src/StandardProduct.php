<?php

namespace src;

use Money\Money;

class StandardProduct implements IProduct
{
    private $name;
    private $price;

    function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }
}

?>