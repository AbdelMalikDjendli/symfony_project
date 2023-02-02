<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateTeamController extends AbstractController
{
    #[Route('/create/team', name: 'app_create_team')]
    public function index(): Response
    {
        return $this->render('create_team/index.html.twig', [
            'controller_name' => 'CreateTeamController',
        ]);
    }
}
