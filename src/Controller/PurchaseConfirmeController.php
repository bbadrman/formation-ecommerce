<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\PurchaseItem;
use App\Form\CartConfirmationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

Class PurchaseConfirmeController
{

    protected $formFactory;
    protected $router;
    protected $security;
    protected $cartService;
    protected $em;

    public function __construct(FormFactoryInterface $formFactory, RouterInterface $router, Security $security, CartService $cartService, EntityManagerInterface $em) 
    {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->security = $security;
        $this->cartService = $cartService;
        $this->em = $em;
    }

    /**
     *@Route("/purchase/confirm", name="purchase_confirm")
     */
    public function confirm(Request $request, FlashBagInterface $flashBag)
    {
        //1. nous voulons lire les données du formulaire 
        //FormFactoryInterface / request

        $form = $this->formFactory->create(CartConfirmationType::class);
        $form->handleRequest($request);

        //2. si le formulaire n'a pas été soumis : dégager
        if (!$form->isSubmitted()) {
            //message flash puis redirect to (flashbaginterface)
            $flashBag->add("warning", "vous devez remplir le formulaire de confirmation");
            return new RedirectResponse($this->router->generate('cart_show'));
        }
        //3. si je ne suis pas connecté : degager (security)

        $user = $this->security->getUser();

        if (!$user) {
            throw new AccessDeniedException('Vous devez étre connecté pour confirme une commande');
        }
        //4. si il n' ya a pas de produit dans la panier : degager (CartSecurity
        $cartItems = $this->cartService->getDetailcartItems();
        if (count($cartItems) === 0) {
            $flashBag->add('warning', 'vous ne pouvez confimer une commande avec une pannier vide ');
            return new RedirectResponse($this->router->generate('cart_show'));
        }

        //5. nous allons créer un purchase 
        /** @var Purchase */
        $purchase = $form->getData();
        
        //6. nous allons la lier avec l'utlisateur accutelement connecté (security)
        $purchase->setUser($user)
                  ->setPurchasedAt(new \DateTime());

            $this->em->persist($purchase);
        //7.nous allons la lier avec les produits qui son pas dans la panier  (CartSecurity )
        $total = 0;
        foreach($this->cartService->getDetailcartItems() as $cartItem){
            $purchaseItem = new PurchaseItem();
            $purchaseItem->setPurchase($purchase)
                         ->setProduct($cartItem->product)
                         ->setProductName($cartItem->product->getPrice())
                         ->setQuantity($cartItem->qty)
                         ->setTotal($cartItem->getTotal())
                         ->setProductPrice($cartItem->product->getPrice());

                $total += $cartItem->getTotal();

                $this->em->persist($purchaseItem);
        }

        $purchase->setTotal($total);
        //8. nous allons enregistrer la commande (EntityManagerInterface)
        $this->em->flush();
    
        $flashBag->add('success', "Lacommande à bien été enregistréé");
        return new RedirectResponse($this->router->generate('purchase_index'));
    }
    
}