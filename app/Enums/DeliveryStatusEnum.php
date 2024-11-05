<?php

namespace App\Enums;

use App\Interfaces\FiniteStateMachineInterface;
use App\Traits\EnumTrait;

enum DeliveryStatusEnum: string implements FiniteStateMachineInterface
{
    use EnumTrait;
    case PLANNED = 'planned';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';

    public function isValidTransition(FiniteStateMachineInterface $newState): bool
    {
        $transitions = [
            DeliveryStatusEnum::PLANNED->value => [
                DeliveryStatusEnum::SHIPPED,
            ],
            DeliveryStatusEnum::SHIPPED->value => [
                DeliveryStatusEnum::DELIVERED,
            ],
        ];

        return in_array($newState, $transitions[$this->value]);
    }
}
