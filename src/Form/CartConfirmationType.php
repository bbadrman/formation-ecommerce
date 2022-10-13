<?php

namespace App\Form;

use App\Entity\Purchase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CartConfirmationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Nom complet',
                'attr' => [
                    'placeholder' => 'Nom complet pour livraison',
                ]
            ])
            ->add('address', TextareaType::class, [
                'label' => 'Address complét',
                'attr' => [
                    'placeholder' => 'Address compltét pour livraison',
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Postal Code',
                'attr' => [
                    'placeholder' => 'Postal Code du livraison',
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Ville pour la livraison',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Purchase::class,
        ]);
    }
}
