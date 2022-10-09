<?php

namespace App\Controller;

use App\Cart\CartService;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add/{id}", name="cart_add", requirements={"id":"\d+"})
     */
    public function add($id, ProductRepository $productRepository, CartService $cartService)
    {
        //0. Securisation :est ce que le produit existe?

        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException("Produit $id n'existe pas");
        }
         
        $cartService->add($id);

        // dd($session->get('cart'));*

        /** @var FlashBag */
        // $flashBag = $session->getBag('flashes');
        $this->addFlash('success', "Le produit à bien été ajouté au panier ");

        // $flashBag->add('success', "Le produit à bien été ajouté au panier ");

        // $request->getSession()->remove('cart');

        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }

    /**
     * @Route("/cart", name="cart_show")
     */
    public function show(CartService $cartService) {

        $detailCart = $cartService->getDetailcartItems();
        $total = $cartService->getTotal();
        
       return $this->render('cart/index.html.twig', [
        'items' => $detailCart,
        'total' => $total
       ]);
    }
}
