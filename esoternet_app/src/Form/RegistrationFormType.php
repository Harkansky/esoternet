<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'label_attr' => [
                    'class' => 'block font-medium '
                ],
                'attr' => ['placeholder' => 'Nom',
                            'class' => 'form-input block border border-gray-300 text-sm p-2 w-full shadow-sm focus:outline-none',
                            'style' => 'border-radius:5px'
                        ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse Email',
                'label_attr' => [
                    'class' => 'block font-medium mt-3'
                ],
                'attr' => ['placeholder' => 'Votre email',
                'class' => 'form-input block border border-gray-300 text-sm p-2 w-full shadow-sm focus:outline-none',
                'style' => 'border-radius:5px'
            ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label_attr' => [
                    'class' => 'mr-4'
                ],
                'attr' => [
                'class' => 'mt-3',
            ],
                
                
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Nouveau mot de passe',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 8]),
                ],
                'label_attr' => [
                    'class' => 'block font-medium mt-3'
                ],
                'attr' => ['placeholder' => 'Mot de passe',
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
    }
}
