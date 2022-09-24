<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController

{

    /**
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $em)
    {
       //  pour créer un product 
        $product = new Product();
        $product 
               ->setName('Table en cuivre')
               ->setPrice(3000)
               ->setSlug('table-en-cuivre');

        $em->persist($product);
        $em->flush();

        // Pour modify un produit

        // $productRepository = $em->getRepository(Product::class);
        // $product = $productRepository->find(5);
        // $product->setPrice(3500);
        // $em->flush();

        // Pour supprimer un product
        // $productRepository = $em->getRepository(Product::class);
        // $product = $productRepository->find(5);
        // $em->remove($product);
        // $em->flush();


        return $this->render('home.html.twig');
    }
}
