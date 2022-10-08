<?php

namespace App\Controller;

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
    public function add($id, ProductRepository $productRepository, SessionInterface $session)
    {
        //0. Securisation :est ce que le produit existe?

        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException("Produit $id n'existe pas");
        }
        //1. retrouver le panier dans la session (sous form d'un tableau)
        //2. si il n'existe pas encore alors prendre un tableau vide 
        $cart = $session->get('cart', []);

        // [12 => 4, 23=>3, 40=>1]
        //3. voir si le produit ($id) existe déjà dans le tableau 
        //4. Si c'est le cas, simplement augmenter la quantité
        //5. Sinon, ajouter le produit avec la quantité 1
        if (array_key_exists($id, $cart)) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        //6. Enregistrer le tableau mis à jour dans la session

        $session->set('cart', $cart);
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
}
