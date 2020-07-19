<?php

require 'vendor/autoload.php';

use Money\Money;
use src\Bundle;
use src\Product;
use src\Discounted;

try 
{
    $bundle0 = new Bundle("FirstBundle", new Product(Money::USD(500), "product1"),
                                         new Product(Money::USD(650), "product2"),
                                         new Product(Money::USD(122), "product3"),
                                         new Product(Money::USD(123), "product4"));
    $bundle1 = new Bundle("SecondBundle", new Product(Money::USD(250), "product1"),
                                          new Product(Money::USD(250), "product2"),
                                          new Product(Money::USD(250), "product3"),
                                          new Product(Money::USD(250), "product4"));
    
    $discounted0 = new Discounted(10, new Product(Money::USD(1000), "product1"));
    $discounted1 = new Discounted(20, $bundle1);
    
    $product1   = new Product(Money::USD(10000), "product1");
    $product2   = new Product(Money::USD(10000), "product2");
    $totalPrice = Money::USD(0);
    
    
    $products = [
        $product1,
        $product2,
        $bundle0,
        $bundle1,
        $discounted0,
        $discounted1
    ];
    
    foreach ($products as $product)
    {
        echo $product->getName() . PHP_EOL;
        echo $product->getPrice()->getAmount() . PHP_EOL;
    
        $totalPrice = $totalPrice->add($product->getPrice());
    }
    
    echo 'TOTAL PRICE: ' . $totalPrice->getAmount() . PHP_EOL;
} 
catch (Exception $e) 
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>