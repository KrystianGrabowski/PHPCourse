<?php

namespace promotion;

use cart\Cart;

interface IPromotion
{
    public function checkPromotion(Cart $cart);
}

?>