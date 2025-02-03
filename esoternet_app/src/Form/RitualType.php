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
                'attr'  => ['class' => 'input input-bordered']
            ])
            ->add('description', TextType::class, [
                'label'    => 'Description',
                'required' => false,
                'attr'     => ['class' => 'input input-bordered']
            ])
            ->add('datePerformed', DateType::class, [
                'label'   => 'Date de réalisation',
                'widget'  => 'single_text',
                'required'=> false,
                'mapped'  => false,
                'attr'    => ['class' => 'input input-bordered']
            ])
            ->add('entity', EntityType::class, [
                'class' => Entity::class,
                'choice_label' => 'name',
                'placeholder'  => 'Sélectionnez une entité',
                'required'     => true,
                'attr'         => ['class' => 'select select-bordered']
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
