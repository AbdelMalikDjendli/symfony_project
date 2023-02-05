<?php

namespace App\FormHandler;
use App\Entity\Event;

use App\Entity\Five;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

final class MatchFormHandler
{
    public function __construct(
        public EntityManagerInterface $entityManager,
        public ManagerRegistry $doctrine
    )
    {

    }

    # Equipe pas encore créée par l'utilisateur
    public function handleForm(Event $match, User $user): void
    {

        $this->entityManager->persist($match);
        $this->entityManager->flush();
    }

    # Utilisation d'un utilisateur par défaut déjà créé dans la base de donnée
    # Cet utilisateur doit être la personne connectée
    public function defaultUser(): User{
        return $this->doctrine->getRepository(User::class)->find(1);
    }


    # Utilisation d'un five par défaut déjà créé dans la base de donnée
    # Ce Five doit être celui qui est sélectionné par l'User dans le formulaire
    public function defaultFive() : Five{

        return $this->doctrine->getRepository(Five::class)->find(1);
    }
}