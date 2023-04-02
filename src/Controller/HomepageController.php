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

    public function __construct(public EntityManagerInterface $entityManager,
                                public FiveRepository $fiveRepository )
    {
    }

    #[Route('/homepage/{page}', name: 'app_homepage')]
    public function index(Request $request, int $page = null): Response
    {

        if($page === null){
            return $this->redirectToRoute('app_homepage', ['page' => 1]);
        }
        $eventRepository = $this->entityManager -> getRepository(Event::class);

        //récupère depuis l'url le filtrage des five (méthode GET)
        $fiveFilter = $request -> get("fives");

        //récupère depuis l'url le filtrage du niveau (méthode GET)
        $levelFilter = $request -> get("levels");

        //si l'utilisateur est connecté
        if($this->getUser() != null){
            # appel de l'utilisateur connecté
            $mail = $this->getUser()->getUserIdentifier();
            $userRepository = $this->entityManager -> getRepository(User::class);
            $user = $userRepository -> findOneBy(["email" => $mail]);

            // les matchs qu'il peut rejoindre lui sont affichés avec les filtres
            $allMatches = $eventRepository -> findUserJoinableMatches($user, $fiveFilter, $levelFilter);
        }
        else {
            //tous les matchs joignables
            $allMatches = $eventRepository->findJoinableMatches($fiveFilter, $levelFilter);
        }

        $limit = 3;
        $nbPage =  ceil(count($allMatches)/$limit);
        $debut = ($page*$limit) - $limit;
        $allMatches = array_slice($allMatches,$debut, $limit);

        //interception de la requête ajax qui compte les informations du filtrage
        if($request -> get('ajax') == 1){
            return new JsonResponse([

                // renderView retourne le HTML des nouvelles annonces de match
                'content' => $this->renderView('homepage/main_content.html.twig', [
                        'controller_name' => 'HomepageController',
                        'matches' => $allMatches,
                        'currentPage' => $page,
                        'nbPage' => $nbPage
                    ])
            ]);
        }

        $allFives = $this->fiveRepository -> findAll();
        $allLevels = array('beginner', 'intermediate', 'confirmed');

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'matches' => $allMatches,
            'allFives' => $allFives,
            'allLevels' => $allLevels,
            'currentPage' => $page,
            'nbPage' => $nbPage
        ]);
    }
}
