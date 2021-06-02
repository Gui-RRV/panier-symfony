<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        $productNames = [
            'Lait',
            'Stylo',
            'Ordinateur Portable',
            'Clé USB 15go',
            'Disque dur 1to',
            'Playstation 5',
            'Les sims 4 DLC : vie citadine',
            'Super fer à souder RX3000',
            'Franck Provost Couleur pour cheveux',
            'Paire de Joycon',
            'Super perceuse à percussion 8000',
            'Monster Hunter Rise',
        ];

        $description  = 'I love cheese, especially cheeseburger cheeseburger. Mascarpone parmesan chalk and cheese jarlsberg halloumi red leicester queso danish fontina. Stilton taleggio who moved my cheese cauliflower cheese smelly cheese everyone loves dolcelatte who moved my cheese. Cream cheese manchego.';

        $imgName = 'http://placehold.it/400x400';

        $replaceArray = [
            'é' => 'e',
            'à' => 'a'
        ];
        foreach ($productNames as $productName) {


            $product = new Products();
            $productSlug = strtolower(strtr($productName,$replaceArray));
            $productSlug = preg_replace('/\s+/', '-',$productSlug);

            $product->setName($productName)
                    ->setDescription($description)
                    ->setImg($imgName)
                    ->setSlug($productSlug)
                    ->setPrice(mt_rand(10,250));



            $manager->persist($product);
        }
            


        

        $manager->flush();
    }
}
