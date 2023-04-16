<?php

namespace App\FormHandler;
use App\Entity\Event;

use App\Entity\Five;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

final class CreateMatchFormHandler
{
    public function __construct(public EntityManagerInterface $entityManager,
                                public ManagerRegistry $doctrine
    )
    {

    }
    public function handleForm($form, Event $match):void
    {
        $team = $form->get('teamsEvent')->getData();
        $this->entityManager->persist($team);

        $match->addTeam($team);
        $this->entityManager->persist($match);
        $this->entityManager->flush();
    }



}