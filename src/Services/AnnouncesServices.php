<?php

namespace App\Services;
use App\Repository\EventRepository;

class AnnouncesServices{
    public function __construct(
        public EventRepository $eventRepository,

        public CommonServices $commonServices)
    {
    }

    public function getAllJoignableMatchs($user = null, $fiveFilter = null, $levelFilter = null):array
    {
        if($user != null){
            $this->commonServices ->getUserConnected($user->getUserIdentifier());
            $allMatches = $this->eventRepository -> findUserJoinableMatches($user, $fiveFilter, $levelFilter);
        }
        else {
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