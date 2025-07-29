<?php

namespace App\Form;

use App\Entity\Nota;
use App\Entity\Alumno;
use App\Entity\DictadoCurso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NotaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('valor', NumberType::class, [
                'label' => 'Nota',
            ])
            ->add('alumno', EntityType::class, [
                'class' => Alumno::class,
                'choice_label' => function($alumno) {
                    return $alumno->getNombre() . ' ' . $alumno->getApellido();
                },
                'label' => 'Alumno',
            ])
            ->add('dictado', EntityType::class, [
                'class' => DictadoCurso::class,
                'choice_label' => function($dictado) {
                    return $dictado->getCurso() ? $dictado->getCurso()->getNombre() : '';
                },
                'label' => 'Dictado de Curso',
            ])
            ->add('documento', TextType::class, [
                'required' => false,
                'label' => 'Documento (opcional)'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nota::class,
        ]);
    }
} 