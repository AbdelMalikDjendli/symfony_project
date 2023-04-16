<?php

namespace App\Controller;

use App\FormHandler\CreateTeamHandler;
use App\Repository\UserRepository;
use App\Services\CommonServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Team;
use App\Entity\User;
use App\Form\CreateTeamType;

class TeamController extends AbstractController
{

    public function __construct(
        public EntityManagerInterface $entityManager,

        public CommonServices $commonServices,

        public CreateTeamHandler $createTeamHandler)
    {
    }

    #[Route('/user/createteam/', name: 'app_create_team', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $user = $this->commonServices->getUserConnected($this->getUser()->getUserIdentifier());

        $equipe = new Team();

        $form = $this->createForm(CreateTeamType::class, $equipe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->createTeamHandler->handleForm($equipe, $user);

            return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
            # rediriger maintenant le formulaire (une fois envoyé) vers la page d'accueil ou sur la page du match
        }

        return $this->render('team/createteam.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/team/voir/{page}', name: 'app_team_read')]
    public function read(int $page): Response
    {
        # appel de l'utilisateur connecté
        $mail = $this->getUser()->getUserIdentifier();
        $teams = $this->commonServices->getUserConnected($mail)->getTeams();

        return $this->render('profil/team.html.twig', [
            'UserTeams'=> $this->commonServices->pagination($page,10,$teams)[0],
            'nbPage'=>$this->commonServices->pagination($page,10,$teams)[1],
            'currentPage'=>$page
        ]);

    }
}
