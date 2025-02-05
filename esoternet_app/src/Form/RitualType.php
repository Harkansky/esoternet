<?php
// src/Form/RitualType.php
namespace App\Form;

use App\Entity\Entity;
use App\Entity\Ritual;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RitualType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du Rituel',
                'attr'  => ['class' => 'input input-bordered'],
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
                'attr' => ['placeholder' => 'Votre nom complet',
                            'class' => 'form-input block border border-gray-300 text-sm p-2 w-full shadow-sm focus:outline-none',
                            'style' => 'border-radius:5px'
                        ],
            ])
            ->add('datePerformed', DateType::class, [
                'label'   => 'Date de réalisation',
                'widget'  => 'single_text',
                'required'=> false,
                'mapped'  => false,
                'label_attr' => [
                    'class' => 'block font-medium '
                ],
                'attr' => ['placeholder' => 'Votre nom complet',
                            'class' => 'form-input block border border-gray-300 text-sm p-2 w-full shadow-sm focus:outline-none',
                            'style' => 'border-radius:5px'
                        ],
            ])
            ->add('entity', EntityType::class, [
                'class' => Entity::class,
                'choice_label' => 'name',
                'placeholder'  => 'Sélectionnez une entité',
                'required'     => true,
                'label_attr' => [
                    'class' => 'block font-medium mt-3 '
                ],
                'attr' => ['class' => 'select w-full max-w-xs block border border-gray-500',
                            'style' => 'border-color:darkgray'
                            ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ritual::class,
        ]);
    }
}
