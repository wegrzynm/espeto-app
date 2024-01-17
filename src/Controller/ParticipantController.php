<?php

namespace App\Controller;

use App\Repository\ParticipantRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    private readonly int $maxResultPerPage;
    public function __construct(private readonly ParticipantRepository $participantRepository)
    {
        $this->maxResultPerPage = 10;
    }

    #[Route('/participant/{page}', name: 'app_participant')]
    public function index(int $page=0): Response
    {
        $numberOfParticipants = count($this->participantRepository->countAllFromCurrentEvents(new DateTime()));
        $numberOfPages = ceil(($numberOfParticipants/$this->maxResultPerPage));
        $participants = $this->participantRepository->findAllFromCurrentEvents(new DateTime(),($page*$this->maxResultPerPage), $this->maxResultPerPage);

        return $this->render('participant/index.html.twig', [
            'controller_name' => 'ParticipantController',
            'participants' => $participants,
            'numberOfPages' => $numberOfPages - 1,
            'pageNo' => $page
        ]);
    }
}
