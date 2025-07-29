<?php

namespace App\Form;

use App\Entity\DictadoCurso;
use App\Entity\Curso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DictadoCursoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('curso', EntityType::class, [
                'class' => Curso::class,
                'choice_label' => 'nombre',
                'label' => 'Curso',
            ])
            ->add('fechaInicio', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de Inicio',
            ])
            ->add('fechaFin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de Fin',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DictadoCurso::class,
        ]);
    }
} 