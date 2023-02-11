<?php

namespace App\Controller;


use App\Entity\Event;
use App\Entity\User;
use App\Form\MatchCreatorType;
use App\Form\MatchResulType;
use App\FormHandler\MatchFormHandler;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;
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

            echo "form envoyé";

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



}