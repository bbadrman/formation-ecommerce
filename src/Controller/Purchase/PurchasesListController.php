<?php

namespace App\Controller\Purchase;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchasesListController extends AbstractController
{
    /**
     * @Route("/purchases", name="purchase_index")
     * @IsGranted("ROLE_USER", message="Vous devez étre connecté pour accéder à vos commandes")
     */
    public function index()
    {
        //1. nous devons assurer que la persone est connecté sino en redicteToRoute page d'accueil ->securty
       
        /** @var User */
        $user = $this->getUser();
      


        return $this->render('purchase/index.html.twig',[
            'purchases' => $user->getPurchases()
            
        ]);
      
    }
}
