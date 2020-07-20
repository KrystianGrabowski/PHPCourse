<?php

use Money\Money;

interface IProduct 
{
    public function getId(): int;
    public function getName(): string;
    public function getPrice(): Money;
}

?>