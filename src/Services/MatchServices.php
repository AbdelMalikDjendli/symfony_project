<?php

namespace App\Services;

class MatchServices
{
    public function verificationForAddResult($match,$eventRepository,$user)
    {
        #Vérifier qu'un resultat n'a pas deja été renseigné
        #Vérifier que le match a bien un invité
        #verification que la personne tentant d'ajouter un resultat est bien organisatrice du match
        if($match->getWinner()!= NULL) {
            return false;
        } elseif(count($match->getTeamsEvent())<=1) {
            return false;
        } elseif( !in_array($match->getId(),$this->getMatchOrganisatedByUser($eventRepository, $user))) {
            return false;
        } else {
            return true;
        }

    }

    public function getMatchOrganisatedByUser($eventRepository,$user)
    {
        # recupération des match organisé par l'utilisateur
        $userOrganisatedMatch = $eventRepository ->findBy(["organizer" => $user]);

        #stockage des id des match organisés par le user dans un tableau
        $idEvents = array();
        foreach($userOrganisatedMatch as $event ){
            $idEvents[] = $event->getId();
        }

        return $idEvents;
    }

    public function getInvitedAndOrganizer($match)
    {
        $invited = $match->getInvited();
        $organizer = $match->getOrganizer()->getPseudo();

        $info = array();
        $info[0]=$invited;
        $info[1]=$organizer;

        return $info;
    }
}