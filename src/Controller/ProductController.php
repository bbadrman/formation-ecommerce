<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/{slug}", name="product_category")
     */
    public function category($slug, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);
       
        if (!$category){
            throw $this->createNotFoundException( "la catégorie demandée n'existe pas "); 
        }
        return $this->render('product/category.html.twig', [
            'slug' => $slug,
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{category_slug}/{slug}", name="product_show")
     */
    public function show($slug, ProductRepository $productRepository)
    {
        $product = $productRepository->findOneBy([
            'slug' => $slug,
        ]);
        if(!$product){
            throw $this->createNotFoundException('Product not found');
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/admin/products/create", name="products_create")
     */
    public function create(FormFactoryInterface $factory, Request $request, SluggerInterface $slluger, EntityManagerInterface $em) {

        // dump($request);

        $builder = $factory->createBuilder(ProductType::class);
        
        
        $form = $builder->getForm();

        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            $product = $form->getData();
            $product->setSlug(strtolower($slluger->slug($product->getName())));
            $em->persist($product);
            $em->flush();


            // $product = new Product();
            // $product->setName($data['name'])
            //         ->setShortDescription($data['shortDescription'])
            //         ->setPrice($data['price'])
            //         ->setCategory($data['category']);

            dd($product);


        }
       
        $formView = $form->createView();

        return $this->render('product/create.html.twig', [
            'formView' => $formView,
        ]);

    }
}
