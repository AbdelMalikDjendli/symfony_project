<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/homepage/{page}', name: 'app_homepage')]
    public function index(EntityManagerInterface $entityManager, int $page): Response
    {
        $eventRepository = $entityManager -> getRepository(Event::class);

        if($this->getUser() != null){
            # appel de l'utilisateur connecté
            $mail = $this->getUser()->getUserIdentifier();
            $userRepository = $entityManager -> getRepository(User::class);
            $user = $userRepository -> findOneBy(["email" => $mail]);
            #$allMatches = $eventRepository -> findUserJoinableMatches($user);
            $allMatches = $eventRepository -> findAll();

        }
else {
    #$allMatches = $eventRepository->findJoinableMatches();
    $allMatches = $eventRepository->findAll();
}

# pagination
        if($page<0){
            $page = 1;
        }

        $limit = 5;
        $debut = ($page*$limit) - $limit;
        $pagination = array_slice($allMatches,$debut, $limit);

        $nbPage =  ceil(count($allMatches)/$limit);

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'matches' => $pagination,
            'nbPage'=>$nbPage,
            'currentPage'=>$page
        ]);
    }
}
