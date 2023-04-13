<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Form\MatchResulType;
use App\Form\RatingType;
use App\FormHandler\RatingFormHandler;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Services\CommonServices;
use App\Services\RatingServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatingController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {
    }

    #[Route('/user/{id}/note', name: 'app_rating', methods: ['GET', 'POST'])]
    public function index(Request $request, EventRepository $eventRepository, UserRepository $userRepository, EntityManagerInterface $entityManager, int $id, CommonServices $commonServices, RatingFormHandler $formHandler, RatingServices $services): Response
    {
        $mail = $this->getUser()->getUserIdentifier();
        $evaluatedUser = $userRepository->find($id);
        if(!$services->verificationForAddNote($id,$commonServices->getUserConnected($userRepository,$mail),$evaluatedUser,$eventRepository)){
            return $this->redirectToRoute('app_homepage');
       }
        $form = $this->createForm(RatingType::class, $evaluatedUser);
        $form->handleRequest($request);
        # lorsque la requête est envoyée et vérifiée
        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->action($form,$evaluatedUser, $commonServices->getUserConnected($userRepository,$mail),$evaluatedUser->getNote(),$evaluatedUser->getNbNote());
            $formHandler->handleForm($evaluatedUser);
            $this->addFlash('success', 'Votre note a bien été prise en compte.');
            return $this->redirectToRoute('app_profil', ['id' => $evaluatedUser->getId()]);
        }
        return $this->render('rating/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
