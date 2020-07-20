<?php

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
    
}

?>