<?php

namespace App\Controller;

use App\FormHandler\CreateTeamHandlerr;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Team;
use App\Entity\User;
use App\Form\CreateTeamType;

class CreateTeamController extends AbstractController
{


    #[Route('/user/createteam/', name: 'app_create_team', methods: ['GET', 'POST'])]
    public function create(Request $request, CreateTeamHandlerr $createTeamHandler, EntityManagerInterface $entityManager): Response
    {
        $userRepository = $entityManager -> getRepository(User::class);

        # appel de l'utilisateur connecté
        $mail = $this->getUser()->getUserIdentifier();


        # récupération de l'entité user
        $user = $userRepository -> findOneBy(["email" => $mail]);

        $equipe = new Team();

        $form = $this->createForm(CreateTeamType::class, $equipe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            echo "form envoyé";
            $createTeamHandler->handleForm($equipe, $user);
            # rediriger maintenant le formulaire (une fois envoyé) vers la page d'accueil ou sur la page du match
        }

        return $this->render('team/createteam.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
