<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Form\MatchResulType;
use App\Form\RatingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatingController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {
    }

    #[Route('/user/{id}/note', name: 'app_rating', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $userRepository = $entityManager -> getRepository(User::class);

        $mail = $this->getUser()->getUserIdentifier();

        # récupération du user qui note
        $user = $userRepository -> findOneBy(["email" => $mail]);

        $evaluatedUser = $userRepository->find($id);

        #seul un utilisateur ayant deja affronté cet utilisateur peut lui donner une note

        $eventRepository = $entityManager -> getRepository(Event::class);

        $organizerInvited = $eventRepository->findBy([
            "organizer"=>$user,
            "invited"=>$evaluatedUser->getPseudo()
        ]);

        $invitedOrganizer = $eventRepository->findBy([
            "organizer"=>$evaluatedUser,
            "invited"=>$user->getPseudo()
        ]);


        if(empty($organizerInvited) and empty($invitedOrganizer)){
            return $this->redirectToRoute('app_homepage');
        }

        #peut donner une seul note a un meme utilisateur

        if($evaluatedUser->getEvaluator()->contains($user)){
            return $this->redirectToRoute('app_homepage');
        }

        #ne peux pas s'evaluer tout seul
        if($id == $user->getId()){
            return $this->redirectToRoute('app_homepage');
        }

        # recuperation des anciennes valeurs de note et nbnote
        $oldNote = $evaluatedUser->getNote();
        $nbNote = $evaluatedUser->getNbNote();

        $form = $this->createForm(RatingType::class, $evaluatedUser);

        # le formulaire saisit la requête
        $form->handleRequest($request);

        # lorsque la requête est envoyée et vérifiée
        if ($form->isSubmitted() && $form->isValid()) {

            echo "form envoyé";

            # récupération de la note depuis le formulaire
            $note = $form->get('note')->getData();

            # mise a jour des données
            $evaluatedUser->setNote($oldNote+$note);
            $evaluatedUser->setNbNote($nbNote+1);

            #ajouter l'evaluateur a evaluator

            $evaluatedUser->addEvaluator($user);


            $this->entityManager->persist($evaluatedUser);
            $this->entityManager->flush();

            # rediriger maintenant le formulaire (une fois envoyé) vers la page d'accueil ou sur la page du match
        }



        return $this->render('rating/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
