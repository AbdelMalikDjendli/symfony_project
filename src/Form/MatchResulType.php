<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                        'Moi' => $organizer,
                        'L\'adversaire' => $invited,
                    ],
                    'label'=> 'Qui est le gagnant ?'
                ])

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
