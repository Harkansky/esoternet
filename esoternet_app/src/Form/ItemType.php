<?php
namespace App\Form;

use App\Entity\Item;
use App\Entity\Pact;
use App\Entity\Ritual;
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
                'label' => 'Nom de l\'Item'
            ])
            ->add('description', TextType::class, [
                'label'    => 'Description',
                'required' => false,
            ])
            ->add('price', MoneyType::class, [
                'label'    => 'Prix',
                'currency' => 'EUR'
            ])
            ->add('existingRituals', EntityType::class, [
                'class' => Ritual::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'mapped' => false,
            ])
            ->add('newRituals', CollectionType::class, [
                'entry_type' => RitualType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'required' => false,
                'mapped' => false,
                'label' => 'Nouveaux rituels',
            ])
            ->add('existingPacts', EntityType::class, [
                'class' => Pact::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'mapped' => false,
            ])
            ->add('newPacts', CollectionType::class, [
                'entry_type' => PactType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'required' => false,
                'mapped' => false,
                'label' => 'Nouveaux pactes',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }
}
