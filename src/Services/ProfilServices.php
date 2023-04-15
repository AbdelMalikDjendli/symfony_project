<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Integer;

class ProfilServices
{
    public function getArrayOfInvitedId($matches, UserRepository $userRepository): array
    {
        $invitedId = array();
        foreach($matches as $match){
            $invited = $userRepository->findby(
                ['pseudo'=>$match->getInvited()]
            );
            if(count($invited)>0) {
                $invitedId[$match->getInvited()] = $invited[0]->getId();
            }
        }

        return $invitedId;
    }

    public function getInfoUserMatch(User $user,EventRepository $eventRepository, int $id):array
    {
        $info = array();
        $matchJoinded = $eventRepository->findBy(
            ['invited'=>$user->getPseudo()]
        );
        $matchCreated = $eventRepository->findBy(
            ['organizer'=>$id]
        );
        $matchWin = $eventRepository->findMatchWin($user->getPseudo());
        $matchLoose = $eventRepository->findMatchLoose($user->getPseudo());

        $info[0] = $matchJoinded;
        $info[1] = $matchCreated;
        $info[2] = $matchWin;
        $info[3] = $matchLoose;

        return $info;
    }

    public function getNoteUser(User $user)
    {
        $note = NULL;
        $nbNote = $user->getNbNote();

        if($nbNote>0) {
            $note = round($user->getNote() / $nbNote);
        }

        return $note;
    }

}