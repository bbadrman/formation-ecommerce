<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
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
                ->add('mainPicture', UrlType::class, [
                    'label' => 'Main picture',
                    'attr' => [
                    'placeholder' => 'Taper une url d\'image !']
                ])
                ->add('category', EntityType::class, [
                    'label' => 'Catégorie',
                     
                        'placeholder' => '-- choisir une catégorie --',
                        'class' => Category::class,
                        'choice_label' => function(Category $category) {
                            return strtoupper($category->getName());
                        }
                    
                ]);

    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
