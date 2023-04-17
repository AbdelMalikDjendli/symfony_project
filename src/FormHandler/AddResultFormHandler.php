<?php

namespace App\FormHandler;

use Doctrine\ORM\EntityManagerInterface;

final class AddResultFormHandler
{
    public function __construct(
        public EntityManagerInterface $entityManager
    )
    {
    }
    public function handleForm($match): void
    {
        $this->entityManager->persist($match);
        $this->entityManager->flush();
    }

    public function action($form,$match,$organizer,$invited):void
    {
        # récupération du gagnant depuis le formulaire
        $winner = $form->get('winner')->getData();

        # deduire le perdant
        if($winner == $organizer){
            $match->setLooser($invited);
        }
        else{
            $match->setLooser($organizer);
        }
    }
}