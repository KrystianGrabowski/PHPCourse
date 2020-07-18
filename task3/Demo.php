<?php

require 'vendor/autoload.php';

use Money\Money;
use src\Bundle;
use src\Product;
//use src\Discounted;

try 
{
    $bundle0 = new Bundle("FirstBundle", new Product(Money::USD(500), "headphones"),
                                   new Product(Money::USD(650), "headphones"));
    echo $bundle0->getPrice()->getAmount();
} 
catch (Exception $e) 
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>