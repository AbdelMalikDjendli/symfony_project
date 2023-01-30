<?php

namespace App\Controller;


use App\Entity\Event;
use App\Form\JoinMatchType;

use App\FormHandler\JoinMatchHandler;

use App\FormHandler\MatchFormHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\MatchCreatorType;



class MatchController extends AbstractController
{
    #[Route('/match', name: 'app_match')]
    public function index(): Response
    {
        return $this->render('match/index.html.twig', [
            'controller_name' => 'MatchController',
        ]);
    }



    #[Route('/match/{id}/joinmatch/', name: 'app_match_join', methods: ['GET', 'POST'])]

    public function join(Request $request, JoinMatchHandler $joinMatchHandler, Event $match): Response
    {

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


    #[Route('/match/create', name: 'app_match_create', methods: ['GET', 'POST'])]
    public function create(Request $request, MatchFormHandler $matchFormHandler): Response
    {
        $match = new Event();

        $form = $this->createForm(MatchCreatorType::class, $match);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            echo "form envoyé";
            $matchFormHandler->handleForm($match);
            # rediriger maintenant le formulaire (une fois envoyé) vers la page d'accueil ou sur la page du match
        }




        return $this->render('match/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
