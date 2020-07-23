<?php

namespace promotion;

use cart\Cart;

class PromotionName implements IPromotion
{
    private $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    public function checkPromotion(Cart $cart)
    {
        foreach ($cart->getProducts() as $product)
        {
            if (strpos($product->getName(), $this->name) !== false)
            {
                return true;
            }
        }
        return false;
    }
}

?>