<?php

namespace App\Form;

use App\Entity\Pago;
use App\Entity\Alumno;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PagoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('alumno', EntityType::class, [
                'class' => Alumno::class,
                'choice_label' => function($alumno) {
                    return $alumno->getNombre() . ' ' . $alumno->getApellido();
                },
                'label' => 'Alumno',
            ])
            ->add('cuil', TextType::class)
            ->add('fechaPago', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de Pago',
            ])
            ->add('numeroCuota', IntegerType::class, [
                'label' => 'Número de Cuota',
            ])
            ->add('comprobante', TextType::class, [
                'required' => false,
                'label' => 'Comprobante (opcional)'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pago::class,
        ]);
    }
} 