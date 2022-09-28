<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function create(FormFactoryInterface $factory, Request $request){

        // dump($request);

        $builder = $factory->createBuilder();
        $builder->add('name', TextType::class, [
            'label' => 'Nom du produit',
            'attr' => [
                
                'placeholder' => 'Tapez le Nom du produit',
            ] 
        ])
                ->add('shortDescription', TextareaType::class, [
                    'label' => 'Description courte',
                    'attr' => [
                      
                        'placeholder' => 'Tapez une description assez courte mais parlante pour le visiteur',
                    ] 
                ]) 
                ->add('price', MoneyType::class, [
                    'label' => 'Prix du product',
                    'attr' => [
                       
                        'placeholder' => 'Tapez le prix en Dhs',
                    ] 
                    ])
                ->add('category', EntityType::class, [
                    'label' => 'Catégorie',
                     
                        'placeholder' => '-- choisir une catégorie --',
                        'class' => Category::class,
                        'choice_label' => function(Category $category) {
                            return strtoupper($category->getName());
                        }
                    
                ]);

        $form = $builder->getForm();

        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            $data = $form->getData();

            $product = new Product();
            $product->setName($data['name'])
                    ->setShortDescription($data['shortDescription'])
                    ->setPrice($data['price'])
                    ->setCategory($data['category']);

            dd($product);


        }
       
        $formView = $form->createView();

        return $this->render('product/create.html.twig', [
            'formView' => $formView,
        ]);

    }
}
