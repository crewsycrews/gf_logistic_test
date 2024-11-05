<?php

namespace App\Enums;

use App\Interfaces\FiniteStateMachineInterface;
use App\Traits\EnumTrait;

enum DeliveryStatusEnum: string implements FiniteStateMachineInterface
{
    use EnumTrait;
    case Planned = 'planned';
    case Shipped = 'shipped';
    case Delivered = 'delivered';

    public function isValidTransition(FiniteStateMachineInterface $newState): bool
    {
        $transitions = [
            DeliveryStatusEnum::Planned->value => [
                DeliveryStatusEnum::Shipped,
            ],
            DeliveryStatusEnum::Shipped->value => [
                DeliveryStatusEnum::Delivered,
            ],
        ];

        return in_array($newState, $transitions[$this->value]);
    }
}
