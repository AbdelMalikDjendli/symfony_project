<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Services\ProfilServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfilController extends AbstractController
{
    public function __construct(public UserRepository $userRepository,
                                public EventRepository $eventRepository,

                                public ProfilServices $profilServices)
    {
    }

    #[Route('user/profil/{id}', name: 'app_profil')]
    public function index(int $id): Response
    {
        $user = $this->userRepository->find($id);
        $matches = $this->eventRepository->findMatchCreatedOrJoinded($id, $user->getPseudo());

        return $this->render('profil/index.html.twig', [
            'UserTeams'=>$user->getTeams(),
            'matches'=>$matches,
            'invited'=>$this->profilServices->getArrayOfInvitedId($matches),
            'id'=>$id,
            'pseudo'=>$user->getPseudo(),
            'nbMatch'=>count($matches),
            'nbMatchCreated'=> count($this->profilServices->getInfoUserMatch($user,$id)[1]),
            'nbMatchJoined'=> count($this->profilServices->getInfoUserMatch($user,$id)[0]),
            'nbMatchWin'=>count($this->profilServices->getInfoUserMatch($user,$id)[2]),
            'nbMatchLoose'=>count($this->profilServices->getInfoUserMatch($user,$id)[3]),
            'note'=>$this->profilServices->getNoteUser($user),
            'picture'=> $user->getPhotoFilename(),
            'nbNote'=>$user->getNbNote()
        ]);
    }
}
