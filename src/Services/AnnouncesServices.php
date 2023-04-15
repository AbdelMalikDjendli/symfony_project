<?php

namespace App\Services;
use App\Entity\User;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Integer;

class AnnouncesServices{
    public function __construct(public UserRepository $userRepository,
                                public EventRepository $eventRepository)
    {
    }

    public function getAllJoignableMatchs($user = null, $fiveFilter = null, $levelFilter = null):array
    {
        //si l'utilisateur est connecté
        if($user != null){
            # appel de l'utilisateur connecté
            $mail = $user->getUserIdentifier();
            $this->userRepository -> findOneBy(["email" => $mail]);

            // les matchs qu'il peut rejoindre lui sont affichés avec les filtres
            $allMatches = $this->eventRepository -> findUserJoinableMatches($user, $fiveFilter, $levelFilter);
        }
        else {
            //tous les matchs joignables
            $allMatches = $this->eventRepository->findJoinableMatches($fiveFilter, $levelFilter);
        }

        return $allMatches;
    }

    public function applyPaginationToAnnounces($allMatches, int $currentPage, int $limit):array
    {
        $debut = ($currentPage*$limit) - $limit;

        return array_slice($allMatches,$debut, $limit);
    }
}