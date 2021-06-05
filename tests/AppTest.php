<?php

namespace App\Tests;

use App\Entity\Products;
use App\Service\CartService;
use Monolog\Test\TestCase;

class AppTest extends TestCase{

    

    // public function testTotalPrice(){

    //     $this->
    //     $cartService = $this->getMockClass('CartService');

    //     $testTotalPrice = 0;

    //     for ($i=0; $i <= mt_rand(0,12) ; $i++) { 
    //         $newProduct = new Products();

    //         $newProduct->setPrice(mt_rand(0,1000));

    //         $testCart[]= [
    //             'product' => $newProduct,
    //             'qty' => mt_rand(0,50)
    //         ];
    //     }

    //     foreach ($testCart as $testProduct) {
    //         $price = $testProduct['product']->getPrice();

    //         $testTotalPrice += $testProduct['qty'] * $price ;

    //     }


    //     $this->assertEquals($testTotalPrice,$cartService->getTotalPrice($testCart));

    //}

}