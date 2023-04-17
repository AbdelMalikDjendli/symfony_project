<?php

namespace App\Services;

use App\Entity\Event;
use App\Entity\User;
use App\Repository\EventRepository;

class MatchServices
{
    public function __construct(public EventRepository $eventRepository)
    {
    }

    public function verificationForAddResult(Event $match, User $user):bool
    {
        #Vérifier qu'un resultat n'a pas deja été renseigné
        #Vérifier que le match a bien un invité
        #verification que la personne tentant d'ajouter un resultat est bien organisatrice du match
        if($match->getWinner()!= NULL) {
            return false;
        } elseif(count($match->getTeamsEvent())<=1) {
            return false;
        } elseif( !in_array($match->getId(),$this->getMatchOrganisatedByUser($user))) {
            return false;
        } else {
            return true;
        }

    }

    public function getMatchOrganisatedByUser(User $user):array
    {
        # recupération des match organisé par l'utilisateur
        $userOrganisatedMatch = $this->eventRepository ->findBy(["organizer" => $user]);

        #stockage des id des match organisés par le user dans un tableau
        $idEvents = array();
        foreach($userOrganisatedMatch as $event ){
            $idEvents[] = $event->getId();
        }

        return $idEvents;
    }

    public function getInvitedAndOrganizer(Event $match):array
    {
        $invited = $match->getInvited();
        $organizer = $match->getOrganizer()->getPseudo();

        $info = array();
        $info[0]=$invited;
        $info[1]=$organizer;

        return $info;
    }

    public function setMatch(User $user):Event
    {
        $match = new Event();
        $match->setOrganizer($user);

        return $match;
    }
}