<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class CustomEvent extends Event
{
    public const STARTEVENT = "start.game";
}