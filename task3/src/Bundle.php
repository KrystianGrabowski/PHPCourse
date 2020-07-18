<?php

namespace src;

use Exception;
use Money\Money;

class Bundle implements IProduct 
{
    private $name;
    private $products;
    private $currency;
    private $price;

    function __construct($name, IProduct ... $products)
    {
        $this->name = $name;
        $this->currency = $products[0]->getPrice()->getCurrency();
        if (count($products) == 0) {
            return new Exception("There must me at least one product in bundle");
        }
        foreach ($products as $product)
        {
            if ($this->currency != $product->getPrice()->getCurrency()) 
            {
                return new Exception("All products must have the same currency");
            }
            $this->products[] = $product;
        }
        $this->price = new Money(0, $this->currency);
        $this->countPrice();
    }

    function countPrice()
    {
        foreach ($this->products as $product) 
        {
            $this->price = $this->price->add($product->getPrice());
        }
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