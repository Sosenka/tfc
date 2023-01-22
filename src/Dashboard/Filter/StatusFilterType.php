<?php

namespace App\Dashboard\Filter;

use App\Ticket\Service\TicketStatus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatusFilterType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $statuses = new TicketStatus();

        $resolver->setDefaults([
            'choices' => $statuses->getConstants()
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}