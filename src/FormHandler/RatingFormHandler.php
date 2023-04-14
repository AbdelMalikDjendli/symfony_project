<?php

namespace App\FormHandler;

use Doctrine\ORM\EntityManagerInterface;

final class RatingFormHandler
{
    public function __construct(
        public EntityManagerInterface $entityManager
    )
    {
    }
    public function handleForm($user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function action($evaluatedUser, $user, $oldNote,$nbNote,$note)
    {


        # mise a jour des données
        $evaluatedUser->setNote($oldNote+$note);
        $evaluatedUser->setNbNote($nbNote+1);

        #ajouter l'evaluateur a evaluator

        $evaluatedUser->addEvaluator($user);

        $this->handleForm($evaluatedUser);
    }

}