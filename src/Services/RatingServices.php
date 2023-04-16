<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\EventRepository;

class RatingServices
{

    public function __construct(public EventRepository $eventRepository)
    {
    }

    public function verificationForAddNote($id,$user,$evaluatedUser):bool
    {
        #Verifie si ils ont deja joué ensemble
        #ne peux pas s'evaluer tout seul
        #peut donner une seul note a un meme utilisateur
        if(empty($this->getMatchWhereOrganizer($user,$evaluatedUser)) and empty($this->getMatchWhereInvited($user,$evaluatedUser))){
            return false;
        }elseif($id == $user->getId()) {
            return false;
        }/*elseif($evaluatedUser->getEvaluator()->contains($user)){
            return $false;
        }*/else{
            return true;
        }

    }

    public function getMatchWhereOrganizer($user,$evaluatedUser):array
    {
        $organizerInvited = $this->eventRepository->findBy([
            "organizer"=>$user,
            "invited"=>$evaluatedUser->getPseudo()
        ]);

        return $organizerInvited;
    }

    public function getMatchWhereInvited($user,$evaluatedUser):array
    {
        $invitedOrganizer = $this->eventRepository->findBy([
            "organizer"=>$evaluatedUser,
            "invited"=>$user->getPseudo()
        ]);

        return $invitedOrganizer;
    }

}