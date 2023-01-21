<?php

namespace App\Ticket\Service;

use App\Ticket\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TicketFactory extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function saveTicket($ticketObject): void
    {
        $ticket = new Ticket();
        $ticket
            ->setTopic($ticketObject->getTopic())
            ->setDescription($ticketObject->getDescription())
            ->setStatus($ticketObject->getStatus())
            ->setCategory($ticketObject->getCategory())
            ->setTicketNumber($this->generateTicketNumber());

        $this->getUser()->addTicket($ticket);

        $this->entityManager->persist($ticket);
        $this->entityManager->flush();
    }

    private function generateTicketNumber(): int
    {
        return (time()+ rand(1,1000));
    }
}