<?php

namespace App\Controller;

use App\Controller\Access\UserAccessController;
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

class RatingController extends UserAccessController
{
    public function __construct(public EntityManagerInterface $entityManager,

                                public UserRepository $userRepository,
                                public EventRepository $eventRepository,

                                public RatingServices $ratingServices,
                                public CommonServices $commonServices,

                                public RatingFormHandler $ratingFormHandler)
    {
    }

    #[Route('/user/{id}/note', name: 'app_rating', methods: ['GET', 'POST'])]
    public function index(Request $request, int $id): Response
    {
        $mail = $this->getUser()->getUserIdentifier();
        $evaluatedUser = $this->userRepository->find($id);
        if(!$this->ratingServices->verificationForAddNote($id,$this->commonServices->getUserConnected($mail),$evaluatedUser)){
            return $this->redirectToRoute('app_homepage');
        }
        $oldNote = $evaluatedUser->getNote();
        $nbNote = $evaluatedUser->getNbNote();
        $form = $this->createForm(RatingType::class, $evaluatedUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $evaluatedUser->setNote($oldNote+$form->get('note')->getData());
            $evaluatedUser->setNbNote($nbNote+1);
            $evaluatedUser->addEvaluator($this->commonServices->getUserConnected($mail));
            $this->ratingFormHandler->handleForm($evaluatedUser);
            return $this->redirectToProfil('Votre note a bien été prise en compte.',$evaluatedUser);
        }
        return $this->render('rating/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
