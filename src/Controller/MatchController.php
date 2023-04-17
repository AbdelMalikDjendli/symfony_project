<?php

namespace App\Controller;


use App\Controller\Access\UserAccessController;
use App\Entity\Event;
use App\Form\JoinMatchType;
use App\Form\MatchCreatorType;
use App\Form\MatchResulType;
use App\FormHandler\AddResultFormHandler;
use App\FormHandler\MatchFormHandler;
use App\Repository\EventRepository;
use App\Services\CommonServices;
use App\Services\MatchServices;
use App\Services\ProfilServices;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchController extends UserAccessController
{

    public function __construct(
        public EntityManagerInterface $entityManager,

        public EventRepository        $eventRepository,

        public CommonServices         $commonServices,
        public MatchServices          $matchServices,
        public ProfilServices         $profilServices,

        public AddResultFormHandler   $addResultFormHandler,
        public MatchFormHandler       $matchFormHandler)
    {
    }

    #[Route('user/match/create', name: 'app_match_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $user = $this->commonServices->getUserConnected($this->getUser()->getUserIdentifier());

        $match = $this->matchServices->setMatch($user);
        $form = $this->createForm(MatchCreatorType::class, $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->matchFormHandler->handleForm($form,$match);
            $this->addFlash('success', 'Votre match a bien été créé.');
            return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
        }

            return $this->render('match/create.html.twig', [
                'form' => $form->createView(),
            ]);
        }

    #[Route('user/match/{id}/result', name: 'app_match_result', methods: ['GET', 'POST'])]
    public function addResult(Request $request, int $id):Response
    {
        $match = $this->eventRepository->find($id);
        $mail = $this->getUser()->getUserIdentifier();
        if(!$this->matchServices->verificationForAddResult($match,$this->commonServices->getUserConnected($mail))) {
            return $this->redirectToRoute('app_homepage');
        }
        $form = $this->createForm(MatchResulType::class, $match, ['organizer' => $this->matchServices->getInvitedAndOrganizer($match)[1], 'invited' => $this->matchServices->getInvitedAndOrganizer($match)[0]]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addResultFormHandler->action($form,$match,$this->matchServices->getInvitedAndOrganizer($match)[1],$this->matchServices->getInvitedAndOrganizer($match)[0]);
            $this->addResultFormHandler->handleForm($match);
            $this->addFlash('success', 'Le résultat a bien été pris en compte.');
            return $this->redirectToRoute('app_profil', ['id' => $this->commonServices->getUserConnected($mail)->getId()]);
        }
        return $this->render('match/result.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/match/{eventid}/joinmatch', name: 'app_match_join', methods: ['GET', 'POST'])]
    #[Entity('event', options: ['id' => 'eventid'])]
    //#[Entity('user', options: ['id' => 'userid'])]
    public function join(Request $request, Event $event): Response
    {
        if($event->getInvited() != NULL){
            return $this->redirectToHomepage("Le match à déjà été rejoint.", false);
        }

        $user = $this->commonServices->getUserConnected($this->getUser()->getUserIdentifier());
        $event->setInvited($user->getPseudo());

        $joinform = $this->createForm(JoinMatchType::class, $event);
        $joinform->handleRequest($request);

        if ($joinform->isSubmitted() && $joinform->isValid()) {
            $this->matchFormHandler->handleForm($joinform, $event);
            return $this->redirectToProfil($user, "Vous avez rejoint le match avec succès.");
        }

        return $this->render('joinmatch/joinmatch.html.twig', [
            'joinform' => $joinform->createView(),
        ]);
    }

    #[Route('user/match/voir/{page}', name: 'app_match_read')]
    public function read(int $page): Response
    {
        $mail = $this->getUser()->getUserIdentifier();
        $matches = $this->eventRepository->findMatchCreatedOrJoinded($this->commonServices->getUserConnected($mail)->getId(), $this->commonServices->getUserConnected($mail)->getPseudo());

        return $this->render('profil/mesMatch.html.twig', [
            'matches' =>$this->commonServices->pagination($page,10,$matches)[0],
            'invited'=>$this->profilServices->getArrayOfInvitedId($matches),
            'nbPage'=>$this->commonServices->pagination($page,10,$matches)[1],
            'currentPage'=>$page
        ]);
    }





}