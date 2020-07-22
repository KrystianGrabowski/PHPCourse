<?php

require 'vendor/autoload.php';

use Money\Currency;
use Money\Money;

use src\StandardProduct;
use src\Cart;
use src\PromotionCount;
use src\PromotionMultiOr;
use src\PromotionMultiAnd;
use src\PromotionName;
use src\PromotionPrice;

$product1 = new StandardProduct('TELEWIZOR', new Money(556, new Currency("PLN")));
$product2 = new StandardProduct('headphones', new Money(122, new Currency("PLN")));
$product3 = new StandardProduct('gocart', new Money(1449, new Currency("PLN")));

$cart1 = new Cart();
$cart2 = new Cart();
$cart3 = new Cart();

$cart1->addProduct($product1);
$cart1->addProduct($product2);
$cart1->addProduct($product3);

$promotionName1 = new PromotionName("TELEWIZOR");
$promotionCount1 = new PromotionCount(2);
$promotionCount2 = new PromotionCount(3);
$promotionPrice1 = new PromotionPrice(666);
$promotionPrice2 = new PromotionPrice(3000);

echo "Name1 " . $promotionName1->checkPromotion($cart1) . "\n";
echo "Count1 " . $promotionCount1->checkPromotion($cart1) . "\n";
echo "Count2 " . $promotionCount2->checkPromotion($cart1) . "\n";
echo "Price1 " . $promotionPrice1->checkPromotion($cart1) . "\n";
echo "Price2 " . $promotionPrice2->checkPromotion($cart1) . "\n";

$combined1 = new PromotionMultiOr($promotionName1, $promotionCount2);
$combined2 = new PromotionMultiAnd($promotionName1, $promotionCount2);
$combined3 = new PromotionMultiAnd($promotionName1, $promotionCount1);

echo "Combined1 " . $combined1->checkPromotion($cart1) . "\n";
echo "Combined2 " . $combined2->checkPromotion($cart1) . "\n";
echo "Combined3 " . $combined3->checkPromotion($cart1) . "\n";

//echo count($cart1);
?>