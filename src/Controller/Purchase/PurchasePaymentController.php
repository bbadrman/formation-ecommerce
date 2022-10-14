<?php


namespace App\Controller\Purchase;

use App\Entity\Purchase;
use App\Stripe\StripeService;
use App\Repository\PurchaseRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PurchasePaymentController extends AbstractController

{

    /**
     * @Route("/purchase/pay/{id}", name="purchase_payment_form")
     * @IsGranted("ROLE_USER")
     */
    public function showCartForm($id, PurchaseRepository $purchaseRepository, StripeService $stripeService){

        $purchase = $purchaseRepository->find($id);
        if( 
        !$purchase|| 
        ($purchase && $purchase->getUser() !== $this->getUser()) ||
        ($purchase && $purchase->getStatus() === Purchase::STATUS_PAID)){
            return $this->redirectToRoute('cart');
        }
        
         //dd($intent->client_secret);    

        $intent = $stripeService->getPaymentIntent($purchase);

        return $this->render('purchase/payment.html.twig', [
            'clientSecret' => $intent->client_secret,
            'purchase' => $purchase
        ]);
    }
}