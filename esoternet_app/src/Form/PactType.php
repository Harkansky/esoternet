<?php
namespace App\Form;

use App\Entity\Entity;
use App\Entity\Pact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\EntityCreationType;

class PactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du Pacte',
                'attr'  => ['class' => 'input input-bordered']
            ])
            ->add('effect', TextType::class, [
                'label' => 'Effet',
                'attr'  => ['class' => 'input input-bordered']
            ])
            ->add('duration', TextType::class, [
                'label' => 'Durée (en jours)',
                'required' => false,
                'attr'  => ['class' => 'input input-bordered']
            ])
            ->add('entity', EntityType::class, [
                'class' => Entity::class,
                'choice_label' => 'name',
                'placeholder'  => 'Sélectionnez une entité',
                'required'     => true,
                'attr'         => ['class' => 'select select-bordered']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pact::class,
        ]);
    }
}
