<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
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
    public function create(FormFactoryInterface $factory, CategoryRepository $categoryRepository){

        $builder = $factory->createBuilder();
        $builder->add('name', TextType::class, [
            'label' => 'Nom du produit',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Tapez le Nom du produit',
            ] 
        ])
                ->add('shortDescription', TextareaType::class, [
                    'label' => 'Description courte',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Tapez une description assez courte mais parlante pour le visiteur',
                    ] 
                ]) 
                ->add('price', MoneyType::class, [
                    'label' => 'Prix du product',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Tapez le prix en Dhs',
                    ] 
                    ]);
                    
                $options =[];
                foreach( $categoryRepository->findAll() as $category ){
                    $options[$category->getName()] = $category->getId();
                }
                $builder->add('category', ChoiceType::class, [
                    'label' => 'Catégorie',
                    'attr' => [
                        'class' => 'form-control'],
                        'placeholder' => '-- choisir une catégorie --',
                        'choices' => $options
                    
                ]) ;

        $form = $builder->getForm();
        $formView = $form->createView();

        return $this->render('product/create.html.twig', [
            'formView' => $formView,
        ]);

    }
}
