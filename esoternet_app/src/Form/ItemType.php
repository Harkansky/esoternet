<?php
// src/Form/ItemType.php
namespace App\Form;

use App\Entity\Item;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'Item',
                'label_attr' => [
                    'class' => 'block font-medium '
                ],
                'attr' => ['placeholder' => 'Votre nom complet',
                            'class' => 'form-input block border border-gray-300 text-sm p-2 w-full shadow-sm focus:outline-none',
                            'style' => 'border-radius:5px'
                        ],
            ])
            ->add('description', TextType::class, [
                'label'    => 'Description',
                'required' => false,
                'label_attr' => [
                    'class' => 'block font-medium '
                ],
                'attr' => ['placeholder' => 'Description',
                            'class' => 'form-input block border border-gray-300 text-sm p-2 w-full shadow-sm focus:outline-none',
                            'style' => 'border-radius:5px'
                        ],
            ])
            ->add('price', MoneyType::class, [
                'label'    => 'Prix',
                'currency' => 'EUR',
                'label_attr' => [
                    'class' => 'block font-medium '
                ],
                'attr' => ['placeholder' => 'Prix',
                            'class' => 'form-input block border border-gray-300 text-sm p-2 w-full shadow-sm focus:outline-none',
                            'style' => 'border-radius:5px'
                        ],
            ])
            ->add('existing_rituals', EntityType::class, [
                'class' => \App\Entity\Ritual::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'mapped'   => false,
                'attr'     => ['class' => 'select select-bordered'],
                'label_attr' => [
                    'class' => 'block font-medium mt-3 '
                ],
            ])
            ->add('newRituals', CollectionType::class, [
                'entry_type'   => RitualType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype'    => true,
                'required'     => false,
                'mapped'       => false,
                'label'        => 'Nouveaux rituels',
                'label_attr' => [
                    'class' => 'block font-medium mt-3 '
                ],
            ])
            ->add('existing_pacts', EntityType::class, [
                'class' => \App\Entity\Pact::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'mapped'   => false,
                'label_attr' => [
                    'class' => 'block font-medium mt-3 '
                ],
                'attr' => ['class' => 'select w-full max-w-xs block border border-gray-500',
                            'style' => 'border-color:darkgray'
                            ],
            ])
            ->add('newPacts', CollectionType::class, [
                'entry_type'   => \App\Form\PactType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype'    => true,
                'required'     => false,
                'mapped'       => false,
                'label'        => 'Nouveaux pactes',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }
}
