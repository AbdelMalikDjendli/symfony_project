<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JoinMatchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $user = $options['data']->getOrganizer();

        $builder
            ->add('teams_event',
                EntityType::class, [
                    'mapped' => false,
                    'class' => Team::class,
                    'choice_label' => 'name',
                    'query_builder' => function (TeamRepository $teamRepository) use ($user){
                        return $teamRepository
                            ->createQueryBuilder('request')
                            ->where('request.creator = :user')
                            ->setParameter('user', $user);
                    }

                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
