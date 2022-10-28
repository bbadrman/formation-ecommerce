<?php


namespace App\Controller\Purchase;


use Stripe\Stripe;
use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\PurchaseItem;
use Stripe\Checkout\Session;
use App\Stripe\StripeService;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PurchaseItemRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PurchasePaymentController extends AbstractController

{



    /**
     * @Route("/purchase/pay/{id}", name="purchase_payment_form")
     * @IsGranted("ROLE_USER")
     */
    public function payement($id, Purchase $purchase, CartService $cartService, EntityManagerInterface $entityManager)
    {
        // $cartdetails = [];
        // $cartdetail = $cartService->getDetailcartItems();
        // $purchaseItems = $purchase->getPurchaseItems();
        // $purchaseItems = $purchase->getPurchaseItems();x  
        //dd($purchaseItemRepository->);
        // $cartdetails[] = $cartdetail;

        if (
            !$purchase ||
            ($purchase && $purchase->getUser() !== $this->getUser()) ||
            ($purchase && $purchase->getStatus() === Purchase::STATUS_PAID)
        ) {
            return $this->redirectToRoute('cart');
        }


        $products_for_stripe = [];
        $purchaseService = $cartService->getDetailcartItems();


        foreach ($purchaseService as $product) {

            $products_for_stripe[] = 

                [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => $product->getName(),
                        ],
                        'unit_amount' => $product->getPrice()
                    ]
                ]

            ;
        }
       // dd( $products_for_stripe);
        $clientSecret = 'sk_test_51KcDcVETyoGWNIM7RmWa4ZM61MfVyRqhwGBNM4jWg6FVjwdBMUAsvSVJU3tGXzUqUGEs8VqmzFOB3rfepR5LQ9E100L0wrf0TH';
        \Stripe\Stripe::setApiKey($clientSecret);

        //header('Content-Type: application/json');

        $YOUR_DOMAIN = 'http://localhost:89';

        $session = \Stripe\Checkout\Session::create([
            'line_items' =>  [

                $products_for_stripe,

                // [
                //     'quantity'=>1,
                //     'price_data'=>[
                //         'currency'=>'EUR',
                //         'product_data' => [
                //             'name'=>"hkjld"
                //         ],
                //         'unit_amount'=> 5445
                //     ]
                //     ],

            ],



            'mode' => 'payment',
            'success_url' => $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
      //  dd($session);

        //header("HTTP/1.1 303 See Other");
        //header("Location: " . $session->url);

        return $this->redirect($session->url);
    }
}
