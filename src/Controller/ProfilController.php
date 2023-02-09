<?php

namespace App\Controller;

use App\Entity\User;
use App\Handler\ProfilHandler;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfilController extends AbstractController
{
    #[Route('user/profil/{id}', name: 'app_profil')]
    public function index(UserRepository $userRepository, EventRepository $eventRepository, int $id): Response
    {
        $user = $userRepository->find($id);

        $matches = $eventRepository->findMatchCreatedOrJoinded($id, $user->getPseudo());
        $matchJoinded = $eventRepository->findBy(
            ['invited'=>$user->getPseudo()]
        );
        $matchCreated = $eventRepository->findBy(
            ['organizer'=>$id]
        );
        $matchWin = $eventRepository->findMatchWin($user->getPseudo());
        $matchLoose = $eventRepository->findMatchLoose($user->getPseudo());


        $invitedId = array();
        foreach($matches as $match){
            $invited = $userRepository->findby(
                ['pseudo'=>$match->getInvited()]
            );

            if(count($invited)>0) {
                $invitedId[$match->getInvited()] = $invited[0]->getId();
            }
        }


        return $this->render('profil/index.html.twig', [
            'UserTeams'=>$user->getTeams(),
            'matches'=>$matches,
            'invited'=>$invitedId,
            'id'=>$id,
            'pseudo'=>$user->getPseudo(),
            'nbMatch'=>count($matches),
            'nbMatchCreated'=> count($matchCreated),
            'nbMatchJoined'=> count($matchJoinded),
            'nbMatchWin'=>count($matchWin),
            'nbMatchLoose'=>count($matchLoose)
        ]);
    }
}
