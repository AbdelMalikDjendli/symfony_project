<?php

namespace App\FormHandler;

use App\Entity\Event;
use App\Entity\Figure;
use App\Entity\Five;
use App\Entity\User;
use App\Repository\FiveRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;




final class JoinMatchHandler
{
    public function __construct(
        public EntityManagerInterface $entityManager,

        public ManagerRegistry $doctrine
    ) {}

    # Equipe pas encore créée par l'utilisateur
    public function handleForm(Event $match): void
    {
        $user = $this->defaultUser();

        $match->setOrganizer($user);


        $five = $this->defaultFive();
        $match -> setFive($five);

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
