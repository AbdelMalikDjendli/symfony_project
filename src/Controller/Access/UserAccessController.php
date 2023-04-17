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

    public function redirectToProfil(User $user, $notification = null, bool $success = true):Response
    {
        if($notification != null){
            if($success) {
                $this->addFlash('success', $notification);
            }
            else{
                $this->addFlash('danger', $notification);
            }
        }
        return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
    }

    public function redirectToHomepage($notification = null, bool $success = true):Response
    {
        if($notification != null) {
            if ($success) {
                $this->addFlash('success', $notification);
            } else {
                $this->addFlash('danger', $notification);
            }
        }
        return $this->redirectToRoute('app_homepage', ['page' => 1]);
    }


}