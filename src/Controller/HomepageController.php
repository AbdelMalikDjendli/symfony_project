<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Repository\FiveRepository;
use App\Services\AnnouncesServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{

    public function __construct(public EntityManagerInterface $entityManager,
                                public FiveRepository $fiveRepository,
                                public AnnouncesServices $announcesServices)
    {
    }

    #[Route('/homepage/{page}', name: 'app_homepage')]
    public function index(Request $request, int $page = null): Response
    {
        if($page === null){
            return $this->redirectToRoute('app_homepage', ['page' => 1]);
        }

        $allMatches = $this->announcesServices->getAllJoignableMatchs($this->getUser(), $request -> get("fives"), $request -> get("levels"));
        $matchsToShow = $this->announcesServices->applyPaginationToAnnounces($allMatches, $page, 3);
        $limit = 3;

        if($request -> get('ajax') == 1){
            return new JsonResponse([
                'content' => $this->renderView('homepage/main_content.html.twig', [
                        'matches' => $matchsToShow, 'currentPage' => $page, 'nbPage' => ceil(count($allMatches)/$limit)
                    ])
            ]);
        }
        return $this->render('homepage/index.html.twig', [
            'matches' => $matchsToShow,
            'allFives' => $this->fiveRepository -> findAll(),
            'allLevels' => array('beginner', 'intermediate', 'confirmed'),
            'currentPage' => $page,
            'nbPage' => ceil(count($allMatches)/$limit)
        ]);
    }
}
