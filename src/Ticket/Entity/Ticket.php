<?php

namespace App\Ticket\Entity;

use App\Core\Entity\BaseEntity;
use App\Core\Entity\User;
use App\Ticket\Repository\TicketRepository;
use App\Ticket\Service\TicketStatus;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Status nie powinien być pusty")]
    private ?string $status = TicketStatus::NEW;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Tytuł nie powinien być pusty")]
    private ?string $topic = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Opis nie powinien być pusty")]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Kategoria nie powinna być pusta")]
    private ?string $category = null;

    #[ORM\Column(length: 15, unique: true)]
    private ?string $ticketNumber = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTicketNumber(): ?string
    {
        return $this->ticketNumber;
    }

    /**
     * @param string|null $ticketNumber
     */
    public function setTicketNumber(?string $ticketNumber): void
    {
        $this->ticketNumber = $ticketNumber;
    }
}
