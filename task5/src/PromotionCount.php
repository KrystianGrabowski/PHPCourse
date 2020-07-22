<?php

namespace src;

class PromotionCount implements IPromotion
{
    private $amount;

    function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function checkPromotion(Cart $cart)
    {
        if (count($cart) > $this->amount)
        {
            return true;
        }
        return false;
    }
}

?>