<?php
namespace App\Form;

use App\Entity\Pact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du Pacte',
            ])
            ->add('effect', TextType::class, [
                'label' => 'Effet',
            ])
            ->add('duration', TextType::class, [
                'label'    => 'Durée (en jours)',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pact::class,
        ]);
    }
}
