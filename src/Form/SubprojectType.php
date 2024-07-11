<?php

namespace App\Form;

use App\Entity\Logiciel;
use App\Entity\Pictures;
use App\Entity\Project;
use App\Entity\Subproject;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubprojectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title',TextareaType::class)
        ->add('summary', TextareaType::class)
        ->add('subtitle', TextareaType::class)
            ->add('content',TextareaType::class)
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Brouillon' => 'Brouillon',
                    'Publié' => 'Publié',
                    'Archivé' => 'Archivé'],
                    'expanded'=>true,
            ])            
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'label'=>"Projet",
                'choice_label' => 'title',
            ])
            // entitytype simplifie les relation
            ->add('logiciels', EntityType::class, [
                'class' => Logiciel::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
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
