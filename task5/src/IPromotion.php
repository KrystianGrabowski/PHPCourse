<?php

namespace src;

interface IPromotion
{
    public function checkPromotion(Cart $cart);
}

?>