<?php

namespace App\FormHandler;
use App\Entity\Event;

use App\Entity\Team;
use App\Entity\Five;
use App\Entity\User;
use App\Repository\FiveRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

final class CreateTeamHandlerr
{


    public function __construct(
        public EntityManagerInterface $entityManager,
        public ManagerRegistry $doctrine
    )
    {

    }

    # Equipe pas encore créée par l'utilisateur
    public function handleForm(Team $equipe, int $id): void
    {


        $equipe->setCreator($this->doctrine->getRepository(User::class)->find($id));




        $this->entityManager->persist($equipe);
        $this->entityManager->flush();
    }

    # Utilisation d'un utilisateur par défaut déjà créé dans la base de donnée
    # Cet utilisateur doit être la personne connectée
    /* public function defaultUser(): User{
        return $this->doctrine->getRepository(User::class)->find(id);
    } */

}