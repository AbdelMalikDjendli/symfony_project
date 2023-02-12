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
    #[Route('/homepage', name: 'app_homepage')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $eventRepository = $entityManager -> getRepository(Event::class);

        if($this->getUser() != null){
            # appel de l'utilisateur connecté
            $mail = $this->getUser()->getUserIdentifier();
            $userRepository = $entityManager -> getRepository(User::class);
            $user = $userRepository -> findOneBy(["email" => $mail]);
            $allMatches = $eventRepository -> findUserJoinableMatches($user);
        }

        # récupération de l'entité user
        $allMatches = $eventRepository->findJoinableMatches();

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'matches' => $allMatches
        ]);
    }
}
