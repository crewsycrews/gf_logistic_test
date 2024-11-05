<?php

namespace App\Http\Controllers;

use App\Enums\DeliveryStatusEnum;
use App\Http\Requests\Delivery\ChangeDeliveryStatusRequest;
use App\Models\Delivery;
use App\Services\DeliveryService;
use Symfony\Component\HttpFoundation\Response;

class DeliveryController extends Controller
{
    public function __construct(protected DeliveryService $deliveryService)
    {
    }
    public function statusChange(ChangeDeliveryStatusRequest $request, Delivery $delivery): Response
    {
        $status = $request->enum('status', DeliveryStatusEnum::class);
        $this->deliveryService->changeStatus($delivery, $status);

        return response('', Response::HTTP_OK);
    }
}
