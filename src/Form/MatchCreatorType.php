<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Five;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchCreatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('level',
                ChoiceType::class, [
                    'expanded' => 'true',
                    'choices' => [
                        'Débutant' => "begginer",
                        'Intermédiaire' => "intermediate",
                        'Confirmé' => "confirmed",
                        "Non renseigné" => 'non renseigné'
                    ]])
            ->add('date',
                DateType::class, [
                    'required' => true,
                    'input' => 'string']
            )
            ->add('hour',
                TimeType::class, [
                    'required' => true,
                    'input' => 'string']
            )
            ->add('description',
                TextareaType::class, [
                    'required' => false]
            )
            ->add('five', EntityType::class, [
                'class' => Five::class,
                'choice_label' => 'name'
            ])
            ->add('submit',
                SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ])

        ;
    }
}