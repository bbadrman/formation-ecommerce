<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Purchase;
use App\Cart\CartService;
use App\Repository\ProductRepository;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderSucces extends AbstractController
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;
    /**
     * @var CartService
     */
    protected $cartService;
     /**
     * @var PurchaseRepository
     */
    protected $purchaseRepository;



    public function __construct(ProductRepository $productRepository, CartService $cartService, PurchaseRepository $purchaseRepository)
    {
        $this->productRepository = $productRepository;
        $this->cartService = $cartService;
        $this->purchaseRepository = $purchaseRepository;
 
    }

    /**
     * @Route("/success-url", name="success_url")
     */
    public function seccussUrl(): Response
    {
        // $orders = $this->entityManager->getRepository(Purchase::class)->findBy($id);
        $detailCart = $this->cartService->getDetailcartItems();
        $total = $this->cartService->getTotal();
        $purchase = $this->purchaseRepository->findAll();

        return $this->render('order_success/index.html.twig',
        [
            //  'order' => $orders,
            'items' => $detailCart,
             'totals' => $total,
             'purchases' => $purchase,
           
        ]);
    }

    /**
     * @Route("/cancel-url", name="cancel_url")
     */
    public function cancelUrl(): Response
    {
        $detailCart = $this->cartService->getDetailcartItems();
        $total = $this->cartService->getTotal();

        return $this->render(
            'order_cancel/index.html.twig',
            [
                'items' => $detailCart,
                'total' => $total,
            ]
        );
    }
}
