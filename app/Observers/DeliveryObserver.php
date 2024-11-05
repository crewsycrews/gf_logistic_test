<?php

namespace App\Observers;

use App\Enums\DeliveryStatusEnum;
use App\Events\DeliveryDelivered;
use App\Models\Delivery;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class DeliveryObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Delivery "updated" event.
     */
    public function updating(Delivery $delivery): void
    {
        if ($delivery->isDirty('status') && $delivery->status === DeliveryStatusEnum::DELIVERED) {
            DeliveryDelivered::dispatch($delivery);
        }
    }
}
