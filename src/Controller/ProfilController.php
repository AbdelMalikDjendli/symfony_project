<?php

namespace App\Controller;

use App\Entity\User;
use App\Handler\ProfilHandler;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Services\ProfilServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfilController extends AbstractController
{
    #[Route('user/profil/{id}', name: 'app_profil')]
    public function index(UserRepository $userRepository, EventRepository $eventRepository, int $id, ProfilServices $services): Response
    {
        $user = $userRepository->find($id);
        $matches = $eventRepository->findMatchCreatedOrJoinded($id, $user->getPseudo());

        return $this->render('profil/index.html.twig', [
            'UserTeams'=>$user->getTeams(),
            'matches'=>$matches,
            'invited'=>$services->getArrayOfInvitedId($matches, $userRepository),
            'id'=>$id,
            'pseudo'=>$user->getPseudo(),
            'nbMatch'=>count($matches),
            'nbMatchCreated'=> count($services->getInfoUserMatch($user,$eventRepository,$id)[1]),
            'nbMatchJoined'=> count($services->getInfoUserMatch($user,$eventRepository,$id)[0]),
            'nbMatchWin'=>count($services->getInfoUserMatch($user,$eventRepository,$id)[2]),
            'nbMatchLoose'=>count($services->getInfoUserMatch($user,$eventRepository,$id)[3]),
            'note'=>$services->getNoteUser($user),
            'picture'=> $user->getPhotoFilename(),
            'nbNote'=>$user->getNbNote()
        ]);
    }
}
