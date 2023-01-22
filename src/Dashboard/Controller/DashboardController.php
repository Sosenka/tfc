<?php

namespace App\Dashboard\Controller;

use App\Ticket\Entity\Ticket;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('Admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tfc');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Panel');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Zarządzanie');
        yield MenuItem::linkToCrud('Tickety', 'fa fa-home', Ticket::class);
        yield MenuItem::section('System');
        yield MenuItem::linkToLogout('Wyloguj', 'fas fa-right-from-bracket');
    }
}
