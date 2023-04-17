<?php

namespace App\Controller\Ajax;

use App\Controller\Access\UserAccessController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AjaxHomepageController extends UserAccessController {

    public function updateHomepageContent(array $matchesToShow, int $currentPage, int $nbPage):Response
    {
        return new JsonResponse([
            'content' => $this->renderView('homepage/main_content.html.twig', [
                'matches' => $matchesToShow,
                'currentPage' => $currentPage,
                'nbPage' => $nbPage
            ])
        ]);
    }
}