<?php

namespace App\Controller\Access;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserAccessController extends AbstractController {
    public function preventAccessToNotConnectedUser($user){
        if($user == null){
            $this->addFlash('success', 'Veuillez vous connecter pour créer un match.');
            return $this->redirectToRoute('app_homepage');
        }
    }

    public function redirectToProfil($notification, User $user):Response
    {
        $this->addFlash('success', $notification);
        return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
    }


}