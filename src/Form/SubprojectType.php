<?php

namespace App\Form;

use App\Entity\Logiciel;
use App\Entity\Pictures;
use App\Entity\Project;
use App\Entity\Subproject;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubprojectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('summary')
            ->add('subtitle')
            ->add('content')
            ->add('status')
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'id',
            ])
            ->add('logiciels', EntityType::class, [
                'class' => Logiciel::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('pictures', EntityType::class, [
                'class' => Pictures::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subproject::class,
        ]);
    }
}
