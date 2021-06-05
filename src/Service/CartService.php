<?php

namespace App\Service;

class CartService
{

    public function getTotalPrice($cart){
        
        

        $totalPrice = 0;

        foreach ($cart as $product) {
            $price = $product['product']->getPrice();

            $totalPrice += $product['qty'] * $price ;


            
        }

        

        return $totalPrice;
    }
}