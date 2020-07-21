<?php

namespace src;

use Exception;
use Money\Money;

class Discounted implements IProduct
{
    private $procent;
    private $product;

    function __construct(int $procent, IProduct $product)
    {
        if ($procent < 1 || $procent > 100) 
        {
            throw new Exception("Discount procent should be between 1 and 100");
        }
        $this->procent = $procent;
        $this->product = $product;
    }

    function getName(): string
    {
        return $this->product->getName();
    }
    function getPrice(): Money
    {
        $price = $this->product->getPrice();
        $subVal = $price->multiply($this->procent / 100);
        return $price->subtract($subVal); 
    }
}

?>