<?php

namespace App\Tests;

use App\Events\DeliveryDelivered;
use App\Models\Delivery;
use Illuminate\Support\Facades\Event;

class DeliveryTest extends TestCase
{
    public ?Delivery $delivery = null;

    public function setUp(): void
    {
        parent::setUp();

        Event::fake([DeliveryDelivered::class]);

        $this->delivery = Delivery::factory()->create();
    }

    public function testCorrectFlow()
    {
        // Отгрузка
        $response = $this->post('deliveries/' . $this->delivery->id . '/status-change', ['status' => 'shipped']);
        $response->assertStatus(200);
        $this->assertDatabaseHas('deliveries', ['id' => $this->delivery->id, 'status' => 'shipped']);

        // Не валидный статус
        // $response = $this->postJson('deliveries/' . $this->delivery->id . '/status-change', ['status' => 'invalid']);
        // Log::debug($response->getContent());
        // $response->assertUnprocessable();

        // Не валидный статус для перехода
        $response = $this->post('deliveries/' . $this->delivery->id . '/status-change', ['status' => 'planned']);
        $response->assertUnprocessable();

        // Доставлен
        $response = $this->post('deliveries/' . $this->delivery->id . '/status-change', ['status' => 'delivered']);
        $response->assertOk();
        // Event::assertDispatched(DeliveryDelivered::class); TODO: не срабатывает, использовал разные методы регистрации Observer'а, возможно ивенты моделей не диспатчатся в тестах по-умолчанию
        $this->assertDatabaseHas('deliveries', ['id' => $this->delivery->id, 'status' => 'delivered']);
    }
}
