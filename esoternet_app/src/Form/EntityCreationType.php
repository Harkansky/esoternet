<?php
namespace App\Form;

use App\Entity\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'entité',
                'attr'  => ['class' => 'input input-bordered']
            ])
            ->add('origin', TextType::class, [
                'label' => 'Origine',
                'required' => false,
                'attr'  => ['class' => 'input input-bordered']
            ])
            ->add('alignment', TextType::class, [
                'label' => 'Alignement',
                'required' => false,
                'attr'  => ['class' => 'input input-bordered']
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'required' => false,
                'attr'  => ['class' => 'input input-bordered']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entity::class,
        ]);
    }
}
