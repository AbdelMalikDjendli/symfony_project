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
        $allMatches = $eventRepository->findAll();
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'matches' => $allMatches
        ]);
    }
}
