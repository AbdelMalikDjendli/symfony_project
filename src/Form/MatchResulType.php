<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchResulType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $organizer = $options['organizer'];
        $invited = $options['invited'];
        $builder
            ->add('winner',
                ChoiceType::class, [
                    'choices'  => [
                        'moi' => $organizer,
                        'l\'adversaire' => $invited,
                    ],

                ])

            ->add('submit',
                SubmitType::class,
            );

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'organizer' => null,
            'invited' => null,
        ]);
    }
}