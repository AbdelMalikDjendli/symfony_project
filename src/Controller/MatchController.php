<?php

namespace App\Controller;


use App\Entity\Event;
use App\Entity\User;
use App\Form\MatchCreatorType;
use App\FormHandler\MatchFormHandler;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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

        # si l'utilisateur n'est pas connecté
        if($user == null){

        }

        else {

            # indique l'utilisateur qui crée le match
            $match->setOrganizer($user);

            #
            $form = $this->createForm(MatchCreatorType::class, $match);

            # le formulaire saisit la requête
            $form->handleRequest($request);

            # lorsque la requête est envoyée et vérifiée
            if ($form->isSubmitted() && $form->isValid()) {
                echo "form envoyé";

                # gestion des données reçues
                $matchFormHandler->handleForm($match, $user);

                # rediriger maintenant le formulaire (une fois envoyé) vers la page d'accueil ou sur la page du match
            }

            # affichage de la vue du formulaire de création
            return $this->render('match/create.html.twig', [
                'form' => $form->createView(),
            ]);
        }

    }

}