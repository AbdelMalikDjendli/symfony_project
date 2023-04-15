<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\UserRepository;

class CommonServices
{
    public function __construct(public UserRepository $userRepository)
    {
    }

    public function getUserConnected($mail):User
    {
        # récupération de l'entité user
        $user = $this->userRepository->findOneBy(["email" => $mail]);

        return $user;
    }

    public function pagination($page, $limit,$results):array
    {
        if($page<0){
            $page = 1;
        }
        $debut = ($page*$limit) - $limit;
        $pagination = array_slice($results,$debut, $limit);
        $nbPage =  ceil(count($results)/$limit);

        $resultsOnThePageAndTotalNbResult = array();
        $resultsOnThePageAndTotalNbResult[0] = $pagination;
        $resultsOnThePageAndTotalNbResult[1] = $nbPage;

        return $resultsOnThePageAndTotalNbResult;
    }

}