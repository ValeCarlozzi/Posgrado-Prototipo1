<?php

namespace App\Form;

use App\Entity\Carrera;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CarreraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('ordenanzaAprobacion', TextType::class, [
                'required' => false,
                'label' => 'Ordenanza de Aprobación'
            ])
            ->add('resolucionImplementacion', TextType::class, [
                'required' => false,
                'label' => 'Resolución de Implementación'
            ])
            ->add('coneaAprobacion', TextType::class, [
                'required' => false,
                'label' => 'Aprobación CONEAU'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carrera::class,
        ]);
    }
} 