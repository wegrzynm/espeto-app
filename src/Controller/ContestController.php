<?php

namespace App\Controller;

use App\Repository\ContestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContestController extends AbstractController
{
    public function __construct(private readonly ContestRepository $contestRepository)
    {
    }

    #[Route('/contest', name: 'app_contest')]
    public function index(): Response
    {  
        $contests = $this->contestRepository->findAll();

        return $this->render('contest/index.html.twig', [
            'controller_name' => 'ContestController',
            'contests' => $contests
        ]);
    }
}
