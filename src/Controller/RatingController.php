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
    public function index(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, RatingFormHandler $ratingFormHandler, EventRepository $eventRepository, int $id, RatingServices $services, CommonServices $commonServices): Response
    {
        $mail = $this->getUser()->getUserIdentifier();
        $evaluatedUser = $userRepository->find($id);
        if(!$services->verificationForAddNote($id,$commonServices->getUserConnected($userRepository,$mail),$evaluatedUser,$eventRepository)){
            return $this->redirectToRoute('app_homepage');
        }
        $oldNote = $evaluatedUser->getNote();
        $nbNote = $evaluatedUser->getNbNote();
        $form = $this->createForm(RatingType::class, $evaluatedUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $evaluatedUser->setNote($oldNote+$form->get('note')->getData());
            $evaluatedUser->setNbNote($nbNote+1);
            $evaluatedUser->addEvaluator($commonServices->getUserConnected($userRepository,$mail));
            $ratingFormHandler->handleForm($evaluatedUser);
            $this->addFlash('success', 'Votre note a bien été prise en compte.');
            return $this->redirectToRoute('app_profil', ['id' => $evaluatedUser->getId()]);
        }
        return $this->render('rating/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
