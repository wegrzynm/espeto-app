<?php

namespace App\Controller;

use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    public function __construct(private readonly ParticipantRepository $participantRepository)
    {
    }

    #[Route('/participant', name: 'app_participant')]
    public function index(): Response
    {
        $participants = $this->participantRepository->findAll();
        return $this->render('participant/index.html.twig', [
            'controller_name' => 'ParticipantController',
            'participants' => $participants
        ]);
    }
}
