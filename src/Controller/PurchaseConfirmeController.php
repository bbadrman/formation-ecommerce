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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class PurchaseConfirmeController extends AbstractController
{

     
    protected $cartService;
    protected $em;

    public function __construct( CartService $cartService, EntityManagerInterface $em)
    {
         
        $this->cartService = $cartService;
        $this->em = $em;
    }

    /**
     *@Route("/purchase/confirm", name="purchase_confirm")
     *@IsGranted("ROLE_USER", message="Vous devez étre connecté pour confirme une commande")
     */
    public function confirm(Request $request)
    {
        //1. nous voulons lire les données du formulaire 
        //FormFactoryInterface / request

        $form = $this->createForm(CartConfirmationType::class);
         //$form = $this->formFactory->create(CartConfirmationType::class);  remplacer par abstractecontroller
        
        $form->handleRequest($request);

        //2. si le formulaire n'a pas été soumis : dégager
        if (!$form->isSubmitted()) {
            //message flash puis redirect to (flashbaginterface)
            $this->addFlash('warning', 'Vous devez remplir le formulaire de confirmation');

            //$flashBag->add("warning", "vous devez remplir le formulaire de confirmation");  par abstractecontroller
            return $this->redirectToRoute('cart_show');
            //return new RedirectResponse($this->router->generate('cart_show'));    par abstractecontroller
        }
        //3. si je ne suis pas connecté : degager (security)
        $user = $this->getUser();
        //$user = $this->security->getUser();  par abstractecontroller

        // if (!$user) {
        //     throw new AccessDeniedException('Vous devez étre connecté pour confirme une commande');   remplacer par IsGranted
        // }
        //4. si il n' ya a pas de produit dans la panier : degager (CartSecurity
        $cartItems = $this->cartService->getDetailcartItems();
        if (count($cartItems) === 0) {
            $this->addFlash('warning', 'vous ne pouvez confimer une commande avec une pannier vide ');
            return $this->redirectToRoute('cart_show');
            //return new RedirectResponse($this->router->generate('cart_show'));    par abstractecontroller
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
        foreach ($this->cartService->getDetailcartItems() as $cartItem) {
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

        $this->addFlash('success', "Lacommande à bien été enregistréé");
        return $this->redirectToRoute('purchase_index');
        //return new RedirectResponse($this->router->generate('purchase_index'));    par abstractecontroller
    }
}
