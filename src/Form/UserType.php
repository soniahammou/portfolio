<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'admin' => 'ROLE_ADMIN',
                    'reader' => 'ROLE_READER',
               ],
                'multiple' => true, // Permettre la sélection de plusieurs valeurs
                'expanded' => true, // Afficher les choix comme une série de cases à cocher
            ])
            ->add('password')
            // ->add('isVerified')
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
