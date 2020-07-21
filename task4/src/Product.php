<?php

use Money\Currency;
use Money\Money;

class Product implements IProduct, JsonSerializable 
{
    private $id;
    private $name;
    private $price;

    function __construct(int $id, string $name, Money $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function update($values)
    {
        $amount = isset($values['amount']) ? $values['amount'] : $this->getPrice()->getAmount();
        $currency = isset($values['currency']) ? $values['currency'] : $this->getPrice()->getCurrency();
        
        $this->name = isset($values['name']) ? $values['name'] : $this->getName();
        $this->price = new Money($amount, new Currency($currency));
    }
    
}

?>