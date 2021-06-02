<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\AddCartType;
use App\Service\CartService;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductsRepository $productsRepository): Response
    {

        $products = $productsRepository->getAllOrdByName();

        return $this->render('home.html.twig',[
            'products' => $products
        ]);
    }


    /**
     * @Route("/product/{slug}", name="singleProduct")
     */
    public function showProducts(Products $product, Request $request, CartService $cartService): Response
    {

        $form = $this->createForm(AddCartType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form-> isValid())
        {
            
            $session = $request->getSession();
            $cart = $session->get('cart',[]);   
            $formData = $form->getData();
            $productId = $product->getId();

            if (array_key_exists($productId,$cart)){
                $oldQty = $cart[$productId]["qty"];

                $cart[$productId] = $oldQty + $formData["qty"];

            }else{
                $cart[$productId] = $formData["qty"];
            }

            $session->set('cart',$cart);

            
            
            // $flashMessage = $cartService->addItemToCart($product,$form,$request);
            $cartUrl = "{{path('cart')}}";
            $this->addFlash(
                'success',
                'Le produit <strong>'.$product->getName().'</strong> a bien été ajouté au panier ! <a href="/cart">Voir mon panier</a>'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('product/singleProduct.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }


    /**
     * 
     *@Route("/toJson", name="toJson")
     */
    public function exportProductsToJson(ProductsRepository $productsRepository,SerializerInterface $serializer){

        $products = $productsRepository->findAll();

        return new Response($serializer->serialize($products,'json'));

        
    }




}
