<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class JoinMatchType extends AbstractType

{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $builder
            ->add('teams_event',
                EntityType::class, [
                    'mapped' => false,
                    'class' => Team::class,
                    'choice_label' => 'name',
                    'required' => 'true',
                    'label' => 'Choisi ton équipe',
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
