<?php

namespace App\Controller;

use App\Controller\Ajax\AjaxHomepageController;
use App\Repository\FiveRepository;
use App\Services\AnnouncesServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AjaxHomepageController
{

    public function __construct(
        public EntityManagerInterface $entityManager,
        public FiveRepository $fiveRepository,
        public AnnouncesServices $announcesServices)
    {
    }

    #[Route('/homepage/{page}', name: 'app_homepage')]
    public function index(Request $request, int $page = null): Response
    {

        if($page === null){
            return $this->redirectToHomepage();
        }

        $allMatches = $this->announcesServices->getAllJoignableMatchs($this->getUser(), $request -> get("fives"), $request -> get("levels"));
        $limit = 5;
        $matchsToShow = $this->announcesServices->applyPaginationToAnnounces($allMatches, $page, $limit);

        if($request -> get('ajax') == 1){
            return $this->updateHomepageContent($matchsToShow, $page, ceil(count($allMatches)/$limit));
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
