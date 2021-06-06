<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $nbProducts = $crawler->filter('.product')->count();
        $responseStatus =  $client->getResponse()->getStatusCode();
        fwrite(STDERR, print_r($nbProducts, TRUE));
        $this->assertEquals($responseStatus,200);
        $this->assertGreaterThan('0',$nbProducts);

    }
}