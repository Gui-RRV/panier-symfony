<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{

    private $session;

    public function __construct(SessionInterface $session){
        $this->session = $session;
    }


    /**
     * @Route("/cart", name="cart")
     */
    public function showCart(ProductsRepository $productsRepository,CartService $cartService){

        $cart = $this->session->get('cart',[]);
        $data = [];



        foreach ($cart as $id => $qty) {
            $data[] = [
                'product' => $productsRepository->getAllOrdByName($id),
                'qty' => $qty
            ];
        }

        return $this->render('cart/cart.html.twig',[
            'products' => $data,
            'totalPrice' => $cartService->getTotalPrice($data)
        ]);
    }
    

    /**
     * @Route("/emptyCart/{price}", name="emptyCart")
     */
    public function emptyCart(int $price){

        $this->session->remove('cart');

        $this->addFlash(
            'success',
            'Votre panier de '.$price.' € vient d\'être validé ! <br> vous recevrez bientôt une facture (vous avez bien mis une adresse mail au moins ?!)'
        );

        return $this->redirectToRoute("home");

    }

    /**
     * @Route("/add/{id}", name="addOneProduct")
     */
    public function addOneProductFromCart(int $id){
        $cart = $this->session->get('cart',[]);

        $cart[$id]++;

        $this->session->set('cart',$cart);


        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/delete/{id}", name="deleteProduct")
     */
    public function deleteProductFromCart(int $id){


        $cart = $this->session->get('cart',[]);

        unset($cart[$id]);

        $this->session->set('cart',$cart);

        if ( empty($cart)) {
            return $this->redirectToRoute("home");
        }
        return $this->redirectToRoute("cart");
    }
}
