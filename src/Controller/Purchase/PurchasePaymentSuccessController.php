<?php

namespace App\Controller\Purchase;

use App\Entity\Purchase;
use App\Cart\CartService;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PurchasePaymentSuccessController extends AbstractController
{

    /**
     * @Route("/purhcase/terminate/{id}", name="purhcase_payment_success")
     * @IsGranted("ROLE_USER")
     */
    public function success($id, PurchaseRepository $pruchaseRepository, EntityManagerInterface $em, CartService $cartService){

        //1. je récupére la commande
        $purchase = $pruchaseRepository->find($id);

        if (
            !$purchase|| 
            ($purchase && $purchase->getUser() !== $this->getUser()) ||
            ($purchase && $purchase->getStatus() === Purchase::STATUS_PAID)
        ) {
            $this->addFlash('warning', "La commande n'existe pas");
            return $this->redirectToRoute("purchase_index");
        }

        //2. je la fait passer au status PAYEE (PAID)
        $purchase->setStatus(Purchase::STATUS_PAID);
        $em->flush();

        //3. je vide la pannier
        $cartService->empty();
        //4.je redirege avec un flash vers la liste des commandes
        $this->addFlash('success', 'La commande à été payé avec success');
        return $this->redirectToRoute('purchase_index');
    }
}
