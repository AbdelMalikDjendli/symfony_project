<?php

namespace App\Services;

class RatingServices
{
    public function verificationForAddNote($id,$user,$evaluatedUser,$eventRepository)
    {
        #Verifie si ils ont deja joué ensemble
        #ne peux pas s'evaluer tout seul
        #peut donner une seul note a un meme utilisateur
        if(empty($this->getMatchWhereOrganizer($eventRepository,$user,$evaluatedUser)) and empty($this->getMatchWhereInvited($eventRepository,$user,$evaluatedUser))){
            return false;
        }elseif($id == $user->getId()) {
            return false;
        }/*elseif($evaluatedUser->getEvaluator()->contains($user)){
            return $false;
        }*/else{
            return true;
        }

    }

    public function getMatchWhereOrganizer($eventRepository,$user,$evaluatedUser)
    {
        $organizerInvited = $eventRepository->findBy([
            "organizer"=>$user,
            "invited"=>$evaluatedUser->getPseudo()
        ]);

        return $organizerInvited;
    }

    public function getMatchWhereInvited($eventRepository,$user,$evaluatedUser)
    {
        $invitedOrganizer = $eventRepository->findBy([
            "organizer"=>$evaluatedUser,
            "invited"=>$user->getPseudo()
        ]);

        return $invitedOrganizer;
    }

}