<?php

namespace App\Observers;

use App\Enums\DeliveryStatusEnum;
use App\Events\DeliveryDelivered;
use App\Models\Delivery;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;

class DeliveryObserver implements ShouldHandleEventsAfterCommit
{
    public function created(Delivery $delivery): void
    {
        Log::debug('Delivery created');
    }
    /**
     * Handle the Delivery "updated" event.
     */
    public function updated(Delivery $delivery): void
    {
        Log::debug('Delivery updated');
        if ($delivery->status === DeliveryStatusEnum::Delivered) {
            Log::debug('Delivery is delivered');
            DeliveryDelivered::dispatch($delivery);
        }
    }

    public function saving(Delivery $delivery): void
    {
        Log::debug('Delivery saving');
        if ($delivery->status === DeliveryStatusEnum::Delivered) {
            Log::debug('Delivery is delivered');
            DeliveryDelivered::dispatch($delivery);
        }
    }
    public function saved(Delivery $delivery): void
    {
        Log::debug('Delivery saved');
        if ($delivery->status === DeliveryStatusEnum::Delivered) {
            Log::debug('Delivery is delivered');
            DeliveryDelivered::dispatch($delivery);
        }
    }
}
