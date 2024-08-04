<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderStatus;
use Mockery;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_order()
    {
        // Create test data
        $salesperson = User::factory()->create();
        $deliveryPerson = User::factory()->create();
        $orderStatus = OrderStatus::factory()->create();

        // Mock the Order model
        $orderMock = Mockery::mock(Order::class);
        $orderMock->shouldReceive('create')
            ->once()
            ->with([
                'order_number' => 'ORD001',
                'products' => [
                    ['sku' => 'P001', 'name' => 'Product A', 'type' => 1, 'tags' => 'tag1,tag2', 'price' => 100.00, 'unit_of_measure' => 1],
                ],
                'order_date' => now()->toDateString(),
                'receipt_date' => now()->toDateString(),
                'dispatch_date' => now()->toDateString(),
                'delivery_date' => now()->toDateString(),
                'salesperson_id' => $salesperson->id,
                'delivery_person_id' => $deliveryPerson->id,
                'order_status_id' => $orderStatus->id,
            ])
            ->andReturn(new Order([
                'order_number' => 'ORD001',
                'salesperson_id' => $salesperson->id,
                'delivery_person_id' => $deliveryPerson->id,
                'order_status_id' => $orderStatus->id,
            ]));

        // Bind the mock to the service container
        $this->app->instance(Order::class, $orderMock);

        // Authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Prepare the request data
        $data = [
            'order_number' => 'ORD001',
            'products' => [
                ['sku' => 'P001', 'name' => 'Product A', 'type' => 1, 'tags' => 'tag1,tag2', 'price' => 100.00, 'unit_of_measure' => 1],
            ],
            'order_date' => now()->toDateString(),
            'receipt_date' => now()->toDateString(),
            'dispatch_date' => now()->toDateString(),
            'delivery_date' => now()->toDateString(),
            'salesperson_id' => $salesperson->id,
            'delivery_person_id' => $deliveryPerson->id,
            'order_status_id' => $orderStatus->id,
        ];

        // Send POST request to create order
        $response = $this->postJson('/api/orders', $data);

        // Assert the response status and structure
        $response->assertStatus(201)
                 ->assertJson([
                     'order_number' => 'ORD001',
                     'salesperson_id' => $salesperson->id,
                     'delivery_person_id' => $deliveryPerson->id,
                     'order_status_id' => $orderStatus->id,
                 ]);
    }
}
