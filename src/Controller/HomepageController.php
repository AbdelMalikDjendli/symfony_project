<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Repository\FiveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'app_homepage')]
    public function index(EntityManagerInterface $entityManager, FiveRepository $fiveRepository, Request $request): Response
    {
        $eventRepository = $entityManager -> getRepository(Event::class);

        //récupère depuis l'url le filtrage des five (méthode GET)
        $fiveFilter = $request -> get("fives");

        //récupère depuis l'url le filtrage du niveau (méthode GET)
        $levelFilter = $request -> get("levels");

        //si l'utilisateur est connecté
        if($this->getUser() != null){

            # appel de l'utilisateur connecté
            $mail = $this->getUser()->getUserIdentifier();
            $userRepository = $entityManager -> getRepository(User::class);
            $user = $userRepository -> findOneBy(["email" => $mail]);

            // les matchs qu'il peut rejoindre lui sont affichés avec les filtres
            $allMatches = $eventRepository -> findUserJoinableMatches($user, $fiveFilter, $levelFilter);
        }
        else {
            //tous les matchs joignables
            $allMatches = $eventRepository->findJoinableMatches($fiveFilter, $levelFilter);
        }

        //interception de la requête ajax qui compte les informations du filtrage
        if($request -> get('ajax') == 1){
            return new JsonResponse([

                // renderView retourne le HTML des nouvelles annonces de match
                'content' => $this->renderView('homepage/announces/matches.html.twig', [
                        'controller_name' => 'HomepageController',
                        'matches' => $allMatches
                    ])
            ]);
        }

        $allFives = $fiveRepository -> findAll();

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'matches' => $allMatches,
            'allFives' => $allFives
        ]);
    }

    #[Route('/homepage/{id}', name: 'app_filter')]
    public function matchFilter(EntityManagerInterface $entityManager){

    }
}
