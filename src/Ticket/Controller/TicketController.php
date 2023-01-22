<?php

namespace App\Ticket\Controller;

use App\Core\Entity\User;
use App\Ticket\Entity\Ticket;
use App\Ticket\Form\TicketFormType;
use App\Ticket\Service\TicketFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    public function __construct(
        private TicketFactory $ticketFactory
    )
    {
    }

    #[Route('/zgloszenia', name: 'app_tickets')]
    public function index()
    {
        if (! $user =  $this->getUser())
        {
            return $this->redirectToRoute('app_homepage');
        }
        return $this->render('Site/Ticket/index.html.twig', [
            'tickets' => $this->getUser()->getTickets()
        ]);
    }

    #[Route('/dodaj-zgloszenie', name: 'app_add_ticket')]
    public function post(Request $request)
    {
        if (! $user =  $this->getUser())
        {
            return $this->redirectToRoute('app_homepage');
        }

        $ticket = new Ticket();
        $form = $this->createForm(TicketFormType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ticket = $form->getData();
            $this->ticketFactory->saveTicket($ticket);
            $this->addFlash('success', 'New person saved!');
            return $this->redirectToRoute('app_tickets');
        }

        return $this->render('Site/Ticket/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}