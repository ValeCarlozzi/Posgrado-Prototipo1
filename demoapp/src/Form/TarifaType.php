<?php

namespace App\Form;

use App\Entity\Tarifa;
use App\Entity\Curso;
use App\Entity\Carrera;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class TarifaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('monto', NumberType::class, [
                'label' => 'Monto',
            ])
            ->add('curso', EntityType::class, [
                'class' => Curso::class,
                'choice_label' => 'nombre',
                'required' => false,
                'label' => 'Curso',
            ])
            ->add('carrera', EntityType::class, [
                'class' => Carrera::class,
                'choice_label' => 'nombre',
                'required' => false,
                'label' => 'Carrera',
            ])
            ->add('fechaInicio', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de Inicio',
            ])
            ->add('fechaFin', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Fecha de Fin',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tarifa::class,
        ]);
    }
} 