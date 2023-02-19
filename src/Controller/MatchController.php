<?php

namespace App\Controller;


use App\Entity\Event;
use App\Entity\User;
use App\Form\JoinMatchType;
use App\Form\MatchCreatorType;
use App\Form\MatchResulType;
use App\FormHandler\MatchFormHandler;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
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

                echo "form envoyé";

                # récupération de l'objet team depuis le formulaire
                $team = $form->get('teams_event')->getData();
                $entityManager->persist($team);

                # gestion des données reçues
                $match->addTeam($team);
                $this->entityManager->persist($match);
                $this->entityManager->flush();

                # rediriger maintenant le formulaire (une fois envoyé) vers la page d'accueil ou sur la page du match
            }

            # affichage de la vue du formulaire de création
            return $this->render('match/create.html.twig', [
                'form' => $form->createView(),
            ]);
        }

    #[Route('user/match/{id}/result', name: 'app_match_result', methods: ['GET', 'POST'])]
    public function addResult(Request $request, EntityManagerInterface $entityManager, MatchFormHandler $matchFormHandler, int $id){
        $eventRepository = $entityManager -> getRepository(Event::class);
        $match = $eventRepository->find($id);
        #Vérifier qu'un resultat n'a pas deja été renseigné

        if($match->getWinner()!= NULL){
            return $this->redirectToRoute('app_homepage');
        }


        #Vérifier que le match a bien un invité
        if(count($match->getTeamsEvent())<=1){
            return $this->redirectToRoute('app_homepage');
        }

        $userRepository = $entityManager -> getRepository(User::class);

            # appel de l'utilisateur connecté
        $mail = $this->getUser()->getUserIdentifier();



            # récupération de l'entité user
        $user = $userRepository -> findOneBy(["email" => $mail]);



        # recupération des match organisé par l'utilisateur
        $userOrganisatedMatch = $eventRepository ->findBy(["organizer" => $user]);

        #stockage des id des match organisés par le user dans un tableau
        $idEvents = array();
        foreach($userOrganisatedMatch as $event ){
            $idEvents[] = $event->getId();
        }

        #verification que la personne tentant d'ajouter un resultat est bien organisatrice du match
        if( !in_array($match->getId(),$idEvents) ){
            return $this->redirectToRoute('app_homepage');
        }



        #recuperation du pseudo de l'invité et de l'organisateur
        $invited = $match->getInvited();
        $organizer = $match->getOrganizer()->getPseudo();

        $form = $this->createForm(MatchResulType::class, $match, ['organizer' => $organizer, 'invited' => $invited]);

            # le formulaire saisit la requête
        $form->handleRequest($request);

            # lorsque la requête est envoyée et vérifiée
        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('result', 'Le resultat a bien été pris en compte !');

            # récupération du gagnant depuis le formulaire
            $winner = $form->get('winner')->getData();

            # deduire le perdant
            if($winner == $organizer){
                $match->setLooser($invited);
            }
            else{
                $match->setLooser($organizer);
            }

            $this->entityManager->persist($match);
            $this->entityManager->flush();

                # rediriger maintenant le formulaire (une fois envoyé) vers la page d'accueil ou sur la page du match
            }

            # affichage de la vue du formulaire de création
            return $this->render('match/result.html.twig', [
                'form' => $form->createView(),
            ]);

        }

    #[Route('/user/match/{eventid}/joinmatch', name: 'app_match_join', methods: ['GET', 'POST'])]
    #[Entity('event', options: ['id' => 'eventid'])]
    //#[Entity('user', options: ['id' => 'userid'])]
    public function join(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository, Event $event): Response
    {
        // on ne doit plus pouvoir rejoindre un match si il est complet
        if($event->getInvited() != NULL){
            return $this->redirectToRoute('app_homepage');
        }

        $userRepository = $entityManager -> getRepository(User::class);

        # appel de l'utilisateur connecté
        $mail = $this->getUser()->getUserIdentifier();

        # récupération de l'entité user
        $user = $userRepository -> findOneBy(["email" => $mail]);

        // un utilisateur ne doit pas pouvoir rejoindre un match dont il est organisateur
        if ($event->getOrganizer()->getId() == $user->getId()){
            return $this->redirectToRoute('app_homepage');
        }


        //$user = $userRepository->find($user);
        $pseudo = $userRepository->findPseudoById($user);



        # indique l'utilisateur qui crée le match
        $event->setInvited($pseudo);


        #
        $joinform = $this->createForm(JoinMatchType::class, $event);

        # le formulaire saisit la requête
        $joinform->handleRequest($request);

        # lorsque la requête est envoyée et vérifiée
        if ($joinform->isSubmitted() && $joinform->isValid()) {

            echo "formulaire envoyé";

            # récupération de l'objet team depuis le formulaire
            $team = $joinform->get('teams_event')->getData();
            $entityManager->persist($team);

            # gestion des données reçues
            $event->addTeam($team);
            $this->entityManager->persist($event);
            $this->entityManager->flush();

            # rediriger maintenant le formulaire (une fois envoyé) vers la page d'accueil ou sur la page du match
        }

        # affichage de la vue du formulaire de création
        return $this->render('joinmatch/joinmatch.html.twig', [
            'joinform' => $joinform->createView(),
        ]);
    }

    #[Route('user/match/voir/{page}', name: 'app_match_read')]
    public function read(UserRepository $userRepository, EventRepository $eventRepository, int $page): Response
    {
        # appel de l'utilisateur connecté
        $mail = $this->getUser()->getUserIdentifier();

        # récupération de l'entité user
        $user = $userRepository -> findOneBy(["email" => $mail]);

        $matches = $eventRepository->findMatchCreatedOrJoinded($user->getId(), $user->getPseudo());

        $invitedId = array();
        foreach($matches as $match){
            $invited = $userRepository->findby(
                ['pseudo'=>$match->getInvited()]
            );

            if(count($invited)>0) {
                $invitedId[$match->getInvited()] = $invited[0]->getId();
            }
        }

        # pagination
        if($page<0){
            $page = 1;
        }

        $limit = 10;
        $debut = ($page*$limit) - $limit;
        $pagination = array_slice($matches,$debut, $limit);

        $nbPage =  ceil(count($matches)/$limit);

        return $this->render('profil/mesMatch.html.twig', [
            'matches' =>$pagination,
            'invited'=>$invitedId,
            'nbPage'=>$nbPage,
            'currentPage'=>$page
        ]);
    }





}