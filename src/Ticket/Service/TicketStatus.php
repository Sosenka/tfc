<?php

namespace App\Ticket\Service;

use ReflectionClass;

class TicketStatus
{
    public const NEW = "Nowe";
    public const OPEN = "Otwarte";
    public const IN_PROGRESS = "W trakcie";
    public const CLOSED = "Zamknięte";

    public function getConstants()
    {
        $reflectionClass = new ReflectionClass($this);
        return $reflectionClass->getConstants();
    }
}