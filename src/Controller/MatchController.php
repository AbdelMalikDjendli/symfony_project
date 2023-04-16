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

    public function __construct(public EntityManagerInterface $entityManager)
    {
    }

    #[Route('user/match/create', name: 'app_match_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, MatchFormHandler $matchFormHandler): Response
    {
        $userRepository = $entityManager -> getRepository(User::class);

        # appel de l'utilisateur connecté
        $mail = $this->getUser()->getUserIdentifier();


        # récupération de l'entité user
        $user = $userRepository -> findOneBy(["email" => $mail]);

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
                $entityManager->persist($team);

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
    public function addResult(Request $request, AddResultFormHandler $formHandler, int $id, EventRepository $eventRepository, UserRepository $userRepository, CommonServices $commonServices, MatchServices $services)
    {
        $match = $eventRepository->find($id);
        $mail = $this->getUser()->getUserIdentifier();
        if(!$services->verificationForAddResult($match,$eventRepository,$commonServices->getUserConnected($userRepository,$mail))) {
            return $this->redirectToRoute('app_homepage');
        }
        $form = $this->createForm(MatchResulType::class, $match, ['organizer' => $services->getInvitedAndOrganizer($match)[1], 'invited' => $services->getInvitedAndOrganizer($match)[0]]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->action($form,$match,$services->getInvitedAndOrganizer($match)[1],$services->getInvitedAndOrganizer($match)[0]);
            $formHandler->handleForm($match);
            $this->addFlash('success', 'Le résultat a bien été pris en compte.');
            return $this->redirectToRoute('app_profil', ['id' => $commonServices->getUserConnected($userRepository,$mail)->getId()]);
        }
        return $this->render('match/result.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/match/{eventid}/joinmatch', name: 'app_match_join', methods: ['GET', 'POST'])]
    #[Entity('event', options: ['id' => 'eventid'])]
    public function join(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository, Event $event): Response
    {
        if($event->getInvited() != NULL || $event->getOrganizer()->getId() == $this->getUser()->getId()){
            return $this->redirectToRoute('app_homepage');
        }

        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(["email" => $this->getUser()->getUserIdentifier()]);
        $pseudo = $userRepository->findPseudoById($user);

        $event->setInvited($pseudo);

        $joinform = $this->createForm(JoinMatchType::class, $event);
        $joinform->handleRequest($request);

        if ($joinform->isSubmitted() && $joinform->isValid()) {
            $team = $joinform->get('teams_event')->getData();
            $entityManager->persist($team);

            $event->addTeam($team);
            $entityManager->persist($event);
            $entityManager->flush();

            $this->addFlash('success', 'Vous avez rejoint le match avec succès.');

            return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
        }

        return $this->render('joinmatch/joinmatch.html.twig', [
            'joinform' => $joinform->createView(),
        ]);
    }

    #[Route('user/match/voir/{page}', name: 'app_match_read')]
    public function read(UserRepository $userRepository, EventRepository $eventRepository, int $page, CommonServices $commonServices, ProfilServices $profilServices): Response
    {
        $mail = $this->getUser()->getUserIdentifier();
        $matches = $eventRepository->findMatchCreatedOrJoinded($commonServices->getUserConnected($userRepository,$mail)->getId(), $commonServices->getUserConnected($userRepository,$mail)->getPseudo());

        return $this->render('profil/mesMatch.html.twig', [
            'matches' =>$commonServices->pagination($page,10,$matches)[0],
            'invited'=>$profilServices->getArrayOfInvitedId($matches,$userRepository),
            'nbPage'=>$commonServices->pagination($page,10,$matches)[1],
            'currentPage'=>$page
        ]);
    }





}