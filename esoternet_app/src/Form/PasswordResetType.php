<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class PasswordResetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'disabled' => true,
                'label_attr' => [
                    'class' => 'block font-medium mt-3'
                ],
                'attr' => ['placeholder' => 'Votre email',
                'class' => 'form-input block border border-gray-300 text-sm p-2 w-full shadow-sm focus:outline-none',
                'style' => 'border-radius:5px'
            ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Nouveau mot de passe',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 8])
                ],
                'label_attr' => ['class' => 'block font-medium mt-3'],
                'attr' => ['placeholder' => 'Nouveau mot de passe',
                'class' => 'form-input block border border-gray-300 text-sm p-2 w-full shadow-sm focus:outline-none',
                'style' => 'border-radius:5px'
            
                ],
            ])
            ->add('repeatPassword', PasswordType::class, [
                'label' => 'Répéter le mot de passe',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'label_attr' => [
                    'class' => 'block font-medium mt-3'
                ],
                'attr' => ['placeholder' => 'Répéter le mot de passe',
                'class' => 'form-input block border border-gray-300 text-sm p-2 w-full shadow-sm focus:outline-none',
                'style' => 'border-radius:5px'
            ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
    }
}
