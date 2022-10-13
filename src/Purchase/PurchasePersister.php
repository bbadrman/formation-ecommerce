<?php


namespace App\Purchase;

use DateTime;
use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\PurchaseItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class PurchasePersister {

    protected $security;
    protected $cartService;
    protected $em;

    public function __construct(Security $security, CartService $cartService,EntityManagerInterface $em) {
        $this->security = $security;
        $this->cartService = $cartService;
        $this->em = $em;

    }

    public function storePurchase(Purchase $purchase){
        //Integrer tour ce qu'il faut et persiste la purchase
        //6. nous allons la lier avec l'utlisateur accutelement connecté (security)
        $purchase->setUser($this->security->getUser())

            ->setPurchasedAt(new DateTime())
            ->setTotal($this->cartService->getTotal());

        $this->em->persist($purchase);
        //7.nous allons la lier avec les produits qui son pas dans la panier  (CartSecurity )
 
        foreach ($this->cartService->getDetailcartItems() as $cartItem) {
            $purchaseItem = new PurchaseItem;
            $purchaseItem->setPurchase($purchase)
                ->setProduct($cartItem->product)
                ->setProductName($cartItem->product->getPrice())
                ->setQuantity($cartItem->qty)
                ->setTotal($cartItem->getTotal())
                ->setProductPrice($cartItem->product->getPrice());

        

            $this->em->persist($purchaseItem);
        }
        $this->em->flush();
    }
}