<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\JoinMatchType;

use App\FormHandler\JoinMatchHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchController extends AbstractController
{
    #[Route('/match', name: 'app_match')]
    public function index(): Response
    {
        return $this->render('match/index.html.twig', [
            'controller_name' => 'MatchController',
        ]);
    }


    #[Route('/match/joinmatch', name: 'app_match_join', methods: ['GET', 'POST'])]
    public function join(Request $request, JoinMatchHandler $joinMatchHandler): Response
    {
        $match = new Event();

        $form = $this->createForm(JoinMatchType::class, $match);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            echo "Formulaire envoyé";
            $joinMatchHandler->handleForm($match);
        }


        return $this->render('joinmatch/joinmatch.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
