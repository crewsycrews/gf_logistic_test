<?php

namespace App\Models;

use App\Enums\DeliveryStatusEnum;
use App\Observers\DeliveryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RonasIT\Support\Traits\ModelTrait;

/**
 * Модель доставки
 *
 * @property int $id
 * @property DeliveryStatusEnum $status
 */
class Delivery extends Model
{
    use ModelTrait;
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => DeliveryStatusEnum::class,
        ];
    }

    protected $dispatchesEvents = ['updated', 'saved'];
}
