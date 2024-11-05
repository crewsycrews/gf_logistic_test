<?php

namespace App\Interfaces;

interface FiniteStateMachineInterface
{
    public function isValidTransition(self $newState): bool;
}
