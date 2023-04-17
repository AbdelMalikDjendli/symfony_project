<?php

namespace App\FormHandler;

use App\Entity\Team;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final class CreateTeamHandler
{


    public function __construct(
        public EntityManagerInterface $entityManager
    )
    {

    }

    public function handleForm(Team $equipe, User $user): void
    {


        $equipe->setCreator($user);




        $this->entityManager->persist($equipe);
        $this->entityManager->flush();
    }

}