<?php

namespace App\Http\Requests\Delivery;

use App\Enums\DeliveryStatusEnum;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ChangeDeliveryStatusRequest extends Request
{
    public function rules(): array
    {
        return ['status' => ['required', 'string', Rule::in(DeliveryStatusEnum::values())]];
    }
}
