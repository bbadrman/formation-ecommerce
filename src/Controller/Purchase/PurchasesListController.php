<?php

namespace App\Controller\Purchase;

use App\Entity\User;
use Twig\Environment;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PurchasesListController extends AbstractController
{

    protected $security;
    protected $router;
    protected $twig;

    public function __construct(Security $security, RouterInterface $router, Environment $twig)
    {
        $this->security = $security;
        $this->router = $router;
        $this->twig = $twig;
        
    }

    /**
     * @Route("/purchases", name="purchase_index")
     */
    public function index()
    {
        //1. nous devons assurer que la persone est connecté sino en redicteToRoute page d'accueil ->securty
       
        /** @var User */
        $user = $this->security->getUser();
      

        if (!$user) {
            //Génerer une url en fonction du nom d'une route ->urlGenerator -> RouteInterface
            throw new AccessDeniedException("Vous devez étre connecté pour accéder à vos commandes !");
        }
        //2. nous voulons savoir qui connecté ->securty
        //3. nous voulons passe l'utlistaue connecté au twig afin d'afficher environment twig /response
        $html = $this->twig->render('purchase/index.html.twig',[
            'purchases' => $user->getPurchases()
            
        ]);
        return new Response($html);
    }
}
