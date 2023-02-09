<?php

namespace App\Controller;


use App\Entity\Event;
use App\Entity\User;
use App\Form\JoinMatchType;
use App\Form\MatchCreatorType;
use App\FormHandler\MatchFormHandler;
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

    #[Route('/match/create', name: 'app_match_create', methods: ['GET', 'POST'])]
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

    #[Route('/match/{eventid}/user/{userid}/joinmatch', name: 'app_match_join', methods: ['GET', 'POST'])]
    #[Entity('event', options: ['id' => 'eventid'])]
    #[Entity('user', options: ['id' => 'userid'])]
    public function join(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository, Event $event, User $user): Response
    {

        $user = $userRepository->find($user);
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





}