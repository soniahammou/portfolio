<?php

namespace App\Form;

use App\Entity\Logiciel;
use App\Entity\Project;
use App\Entity\Tags;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextareaType::class)
            ->add('summary', TextareaType::class)
            // TODO:METTRE EN PLACE L UPLOAD D IMAGE
            ->add('picture', FileType::class,[
                'label' => 'Brochure (PDF file)',
                  // unmapped means that this field is not associated to any entity property
                  'mapped' => false,

                  // make it optional so you don't have to re-upload the PDF file
                  // every time you edit the Product details
                  'required' => false,
  
                  // unmapped fields can't define their validation using attributes
                  // in the associated entity, so you can use the PHP constraint classes
                  'constraints' => [
                      new File([
                          'maxSize' => '1024k',
                          'mimeTypes' => [
                              'application/pdf',
                              'application/x-pdf',
                          ],
                          'mimeTypesMessage' => 'Please upload a valid PDF document',
                      ])
                  ],
            
            ])
            ->add('created_at', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('updated_at',  DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Brouillon' => 'Brouillon',
                    'Publié' => 'Publié',
                    'Archivé' => 'Archivé'],
                    'expanded'=>true,
            ])
                    
                               
            ->add('logiciels', EntityType::class, [
                'class' => Logiciel::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('tags', EntityType::class, [
                'class' => Tags::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
