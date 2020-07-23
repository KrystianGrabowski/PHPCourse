<?php

namespace cart;

use Countable;
use Exception;
use Money\Currency;
use Money\Money;
use product\IProduct;

class Cart implements Countable
{
    private $products;

    function __construct()
    {
        $this->products = [];
    }

    public function addProduct(IProduct $product)
    {
        $this->products[] = $product;
    }

    public function getTotalPrice(): Money
    {
        if ($this->count() == 0)
        {
            return new Money(0, new Currency("EUR"));
        }

        $sum = new Money(0, $this->products[0]->getPrice()->getCurrency());
        foreach ($this->products as $product)
        {
            if ($product->getPrice()->getCurrency() != $sum->getCurrency())
            {
                throw new Exception('At least two products have different currencies');
            }
            $sum = $sum->add($product->getPrice());
        }
        return $sum;
    }

    function count()
    {
        return count($this->products);
    }

    public function getProducts()
    {
        return $this->products;
    }
}

?>