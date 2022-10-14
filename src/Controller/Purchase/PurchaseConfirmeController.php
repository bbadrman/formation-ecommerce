<?php

namespace App\Controller\Purchase;

use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\PurchaseItem;
use App\Form\CartConfirmationType;
use App\Purchase\PurchasePersister;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PurchaseItemRepository;
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
    protected $persister;

    public function __construct(CartService $cartService, EntityManagerInterface $em, PurchasePersister $persister)
    {
         
        $this->cartService = $cartService;
        $this->em = $em;
        $this->persister = $persister;
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

        $this->persister->storePurchase($purchase);

        //videz la panier apres la commande 
        //$this->cartService->empty();

        //$this->addFlash('success', "Lacommande à bien été enregistréé");
        

        return $this->redirectToRoute('purchase_payment_form', [
            'id' => $purchase->getId()
        ]);
        //return new RedirectResponse($this->router->generate('purchase_index'));    par abstractecontroller
    }
}
