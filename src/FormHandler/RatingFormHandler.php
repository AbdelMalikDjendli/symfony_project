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

    public function action($form,$evaluatedUser, $user)
    {
        # recuperation des anciennes valeurs de note et nbnote
        $oldNote = $evaluatedUser->getNote();
        $nbNote = $evaluatedUser->getNbNote();

        # récupération de la note depuis le formulaire
        $note = $form->get('note')->getData();

        # mise a jour des données
        $evaluatedUser->setNote($oldNote+$note);
        $evaluatedUser->setNbNote($nbNote+1);

        #ajouter l'evaluateur a evaluator

        $evaluatedUser->addEvaluator($user);
    }

}