<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController 

{

    /**
     * @Route("/", name="home")
     */
    public function home(ProductRepository $productRepository){

        // count([]) 
        // find(id)  recherche avec id
        // findBy([], [])  recherche un seul produit
        // findOneBy([], []) recherche avec cretaires mais un seul produit
        // findAll()   recherche toute les produits

        $product = $productRepository->find(1);

        // dump($product->getMajName());

        return $this->render('home.html.twig');

        
    }
}