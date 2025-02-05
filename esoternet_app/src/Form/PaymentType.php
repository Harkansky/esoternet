<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom complet :',
                'label_attr' => [
                    'class' => 'block font-medium '
                ],
                'attr' => ['placeholder' => 'Votre nom complet',
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
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'label_attr' => [
                    'class' => 'block font-medium mt-3 '
                ],
                'attr' => ['class' => 'select w-full max-w-xs block border border-gray-500',
                            'style' => 'border-color:darkgray'
                            ],
                'data' => 'FR'
            ])
            ->add('street', TextType::class, [
                'label' => 'Adresse',
                'label_attr' => [
                    'class' => 'block font-medium mt-3',
                ],
                'attr' => [
                    'placeholder' => 'Votre adresse',
                    'class' => 'w-full block border border-gray-500 p-2',
                    'style' => 'border-color:darkgray'
                ],
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'label_attr' => [
                    'class' => 'block font-medium mt-3',
                ],
                'attr' => [
                    'placeholder' => 'Votre ville',
                    'class' => 'w-full block border border-gray-500 p-2',
                    'style' => 'border-color:darkgray'
                ],
            ])
            ->add('postal_code', TextType::class, [
                'label' => 'Code Postal',
                'label_attr' => [
                    'class' => 'block font-medium mt-3',
                ],
                'attr' => [
                    'placeholder' => 'Votre code postal',
                    'class' => 'w-full block border border-gray-500 p-2',
                    'style' => 'border-color:darkgray'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{5}$/', //
                        'message' => 'Entrez les 5 chiffres de votre code postal'
                    ]),
                ]
            ])
            ->add('price', HiddenType::class, [
                'data' => $options['price']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Payer',
                'attr' => [
                    'class' => 'btn btn-success mt-6'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'price' => 0
        ]);
    }
}
