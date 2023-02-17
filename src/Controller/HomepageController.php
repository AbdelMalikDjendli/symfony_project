<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Repository\FiveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'app_homepage')]
    public function index(EntityManagerInterface $entityManager, FiveRepository $fiveRepository): Response
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
