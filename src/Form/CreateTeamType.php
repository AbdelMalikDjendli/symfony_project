<?php

namespace App\Form;

use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateTeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['required' => true, 'label' => 'Nom de l\'équipe', ])
            ->add('player1', TextType::class,['required' => true, 'label' => 'Joueur 1', ] )
            ->add('player2', TextType::class, ['required' => true, 'label' => 'Joueur 2', ])
            ->add('player3', TextType::class, ['required' => true, 'label' => 'Joueur 3', ])
            ->add('player4', TextType::class, ['required' => true, 'label' => 'Joueur 4', ])
            ->add('player5', TextType::class,['required' => true, 'label' => 'Joueur 5', ])



        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
