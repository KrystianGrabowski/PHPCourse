<?php

namespace promotion;

use cart\Cart;

class PromotionPrice implements IPromotion
{
    private $price;

    function __construct($price)
    {
        $this->price = $price;
    }

    public function checkPromotion(Cart $cart)
    {
        if ($cart->getTotalPrice()->getAmount() > $this->price)
        {
            return true;
        }
        return false;
    }
}

?>