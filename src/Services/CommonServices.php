<?php

namespace App\Services;

class CommonServices
{
    public function getUserConnected($userRepository,$mail)
    {
        # récupération de l'entité user
        $user = $userRepository -> findOneBy(["email" => $mail]);

        return $user;
    }

    public function pagination($page, $limit,$results)
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