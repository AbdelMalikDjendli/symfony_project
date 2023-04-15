<?php

namespace App\Controller;


use App\Entity\Event;
use App\Entity\User;
use App\Form\JoinMatchType;
use App\Form\MatchCreatorType;
use App\Form\MatchResulType;
use App\FormHandler\AddResultFormHandler;
use App\FormHandler\MatchFormHandler;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Services\CommonServices;
use App\Services\MatchServices;
use App\Services\ProfilServices;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchController extends AbstractController
{

    public function __construct(public EntityManagerInterface $entityManager,

                                public EventRepository $eventRepository,
                                public UserRepository $userRepository,

                                public CommonServices $commonServices,
                                public MatchServices $matchServices,

                                public AddResultFormHandler $addResultFormHandler)
    {
    }

    #[Route('user/match/create', name: 'app_match_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        # appel de l'utilisateur connecté
        $mail = $this->getUser()->getUserIdentifier();


        # récupération de l'entité user
        $user = $this->userRepository -> findOneBy(["email" => $mail]);

        # instanciation du match (vide)
        $match = new Event();

            # indique l'utilisateur qui crée le match
            $match->setOrganizer($user);

            #
            $form = $this->createForm(MatchCreatorType::class, $match);

            # le formulaire saisit la requête
            $form->handleRequest($request);

            # lorsque la requête est envoyée et vérifiée
            if ($form->isSubmitted() && $form->isValid()) {

                # récupération de l'objet team depuis le formulaire
                $team = $form->get('teamsEvent')->getData();
                $this->entityManager->persist($team);

                # gestion des données reçues
                $match->addTeam($team);
                $this->entityManager->persist($match);
                $this->entityManager->flush();

                $this->addFlash('success', 'Votre match a bien été créé.');

                return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
                # rediriger maintenant le formulaire (une fois envoyé) vers la page d'accueil ou sur la page du match
            }

            # affichage de la vue du formulaire de création
            return $this->render('match/create.html.twig', [
                'form' => $form->createView(),
            ]);
        }

    #[Route('user/match/{id}/result', name: 'app_match_result', methods: ['GET', 'POST'])]
    public function addResult(Request $request, int $id)
    {
        $match = $this->eventRepository->find($id);
        $mail = $this->getUser()->getUserIdentifier();
        if(!$this->matchServices->verificationForAddResult($match, $this->commonServices->getUserConnected($mail))) {
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
        // on ne doit plus pouvoir rejoindre un match si il est complet
        if($event->getInvited() != NULL){
            return $this->redirectToRoute('app_homepage');
        }

        # appel de l'utilisateur connecté
        $mail = $this->getUser()->getUserIdentifier();

        # récupération de l'entité user
        $user = $this->userRepository -> findOneBy(["email" => $mail]);

        // un utilisateur ne doit pas pouvoir rejoindre un match dont il est organisateur
        if ($event->getOrganizer()->getId() == $user->getId()){
            return $this->redirectToRoute('app_homepage');
        }


        //$user = $userRepository->find($user);
        $pseudo = $this->userRepository->findPseudoById($user);



        # indique l'utilisateur qui crée le match
        $event->setInvited($pseudo);


        #
        $joinform = $this->createForm(JoinMatchType::class, $event);

        # le formulaire saisit la requête
        $joinform->handleRequest($request);

        # lorsque la requête est envoyée et vérifiée
        if ($joinform->isSubmitted() && $joinform->isValid()) {

            # récupération de l'objet team depuis le formulaire
            $team = $joinform->get('teams_event')->getData();
            $this->entityManager->persist($team);

            # gestion des données reçues
            $event->addTeam($team);
            $this->entityManager->persist($event);
            $this->entityManager->flush();

            $this->addFlash('success', 'Vous avez rejoint le match avec succès.');

            return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
            # rediriger maintenant le formulaire (une fois envoyé) vers la page d'accueil ou sur la page du match
        }

        # affichage de la vue du formulaire de création
        return $this->render('joinmatch/joinmatch.html.twig', [
            'joinform' => $joinform->createView(),
        ]);
    }

    #[Route('user/match/voir/{page}', name: 'app_match_read')]
    public function read(int $page, CommonServices $commonServices, ProfilServices $profilServices): Response
    {
        $mail = $this->getUser()->getUserIdentifier();
        $matches = $this->eventRepository->findMatchCreatedOrJoinded($commonServices->getUserConnected($mail)->getId(), $commonServices->getUserConnected($mail)->getPseudo());

        return $this->render('profil/mesMatch.html.twig', [
            'matches' =>$commonServices->pagination($page,10,$matches)[0],
            'invited'=>$profilServices->getArrayOfInvitedId($matches),
            'nbPage'=>$commonServices->pagination($page,10,$matches)[1],
            'currentPage'=>$page
        ]);
    }





}