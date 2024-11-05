<?php

namespace App\Services;

use App\Enums\DeliveryStatusEnum;
use App\Models\Delivery;
use App\Repositories\DeliveryRepository;
use RonasIT\Support\Services\EntityService;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * @property DeliveryRepository $repository
 * @mixin DeliveryRepository
 */
class DeliveryService extends EntityService
{
    public function __construct()
    {
        $this->setRepository(DeliveryRepository::class);
    }

    public function changeStatus(Delivery $delivery, DeliveryStatusEnum $status): Delivery
    {
        if (!$delivery->status->isValidTransition($status)) {
            throw new UnprocessableEntityHttpException('Invalid status transition');
        }
        $delivery->status = $status;
        $delivery->save();

        return $delivery;
    }
}
