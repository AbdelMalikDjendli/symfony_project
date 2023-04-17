<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\EventRepository;
use App\Repository\UserRepository;

class ProfilServices
{
    public function __construct(public UserRepository $userRepository,
                                public EventRepository $eventRepository)
    {
    }

    public function getArrayOfInvitedId(array $matches): array
    {
        $invitedId = array();
        foreach($matches as $match){
            $invited = $this->userRepository->findby(
                ['pseudo'=>$match->getInvited()]
            );
            if(count($invited)>0) {
                $invitedId[$match->getInvited()] = $invited[0]->getId();
            }
        }

        return $invitedId;
    }

    public function getInfoUserMatch(User $user, int $id):array
    {
        $info = array();
        $matchJoinded = $this->eventRepository->findBy(
            ['invited'=>$user->getPseudo()]
        );
        $matchCreated = $this->eventRepository->findBy(
            ['organizer'=>$id]
        );
        $matchWin = $this->eventRepository->findMatchWin($user->getPseudo());
        $matchLoose = $this->eventRepository->findMatchLoose($user->getPseudo());

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