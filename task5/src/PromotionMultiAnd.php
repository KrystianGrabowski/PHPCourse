<?php

namespace src;

class PromotionMultiAnd implements IPromotion
{
    private $promotions;

    function __construct(IPromotion ... $promotions)
    {
        $this->promotions = $promotions;
    }

    public function checkPromotion(Cart $cart)
    {
        foreach ($this->promotions as $promotion)
        {
            if (!$promotion->checkPromotion($cart))
            {
                return false;
            }
        }
        return true;
    }
}

?>