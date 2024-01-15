<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Contest;
use App\Entity\Participant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Espeto App')
            ->setTitle('<img src="#"/> Espeto App')
            ->renderContentMaximized()
            ->generateRelativeUrls();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Entities');
        yield MenuItem::linkToCrud('Contests', 'fas fa-trophy', Contest::class);
        yield MenuItem::linkToCrud('Participants', 'fas fa-users', Participant::class);
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setPaginatorPageSize(25);
    }

    public function configureAddressCrud(): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Address')
            ->setEntityLabelInPlural('Addresses')
            ->setSearchFields(['city', 'street', 'streetNo']); // Customize the fields available for searching
    }

    public function configureContestCrud(): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Contest')
            ->setEntityLabelInPlural('Contests')
            ->setSearchFields(['id', 'name', 'description']); // Customize the fields available for searching
    }

    public function configureParticipantCrud(): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Participant')
            ->setEntityLabelInPlural('Participants')
            ->setSearchFields(['id', 'name', 'date', 'Contest']); // Customize the fields available for searching
    }
}