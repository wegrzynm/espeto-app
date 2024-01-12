<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'Home Page',
        ]);
    }

    //Experimental url to find what vision our leader had
    #[Route('/menu', name: 'app_menu')]
    public function menu(): Response
    {
        return $this->render('main/menu.html.twig', [
            'controller_name' => 'Menu Page',
        ]);
    }
}
