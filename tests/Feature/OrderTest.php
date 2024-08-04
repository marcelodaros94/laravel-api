<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderStatus;
use Mockery;

class OrderControllerTest extends TestCase
{
    // Use DatabaseTransactions to handle database changes
    use DatabaseTransactions;

    /** @test */
    public function it_can_create_an_order()
    {
        // Create test data
        $salesperson = User::factory()->create();
        $deliveryPerson = User::factory()->create();
        $orderStatus = OrderStatus::factory()->create();

        // Mock the Order model
        $orderMock = Mockery::mock('overload:' . Order::class);
        $orderMock->shouldReceive('create')
            ->once()
            ->with(Mockery::subset([
                'order_number' => 'ORD001',
                'products' => json_encode(
                    ['sku' => 'P001', 'name' => 'Product A', 'type' => 1, 'tags' => 'tag1,tag2', 'price' => 100.00, 'unit_of_measure' => 1]
                ),  // Ensure products is a JSON string
                'order_date' => now()->toDateTimeString(),
                'receipt_date' => now()->toDateTimeString(),
                'dispatch_date' => now()->toDateTimeString(),
                'delivery_date' => now()->toDateTimeString(),
                'salesperson_id' => $salesperson->id,
                'delivery_person_id' => $deliveryPerson->id,
                'order_status_id' => $orderStatus->id,
            ]))
            ->andReturn($orderMock);

        $orderMock->shouldReceive('toArray')->andReturn([
            'order_number' => 'ORD001',
            'salesperson_id' => $salesperson->id,
            'delivery_person_id' => $deliveryPerson->id,
            'order_status_id' => $orderStatus->id,
        ]);

        $orderMock->shouldReceive('getAttribute')->andReturnUsing(function ($key) use ($orderMock) {
            return $orderMock->$key;
        });

        // Authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Prepare the request data
        $data = [
            'order_number' => 'ORD001',
            'products' => json_encode(
                ['sku' => 'P001', 'name' => 'Product A', 'type' => 1, 'tags' => 'tag1,tag2', 'price' => 100.00, 'unit_of_measure' => 1]
            ),  // Ensure products is a JSON string
            'order_date' => now()->toDateTimeString(),
            'receipt_date' => now()->toDateTimeString(),
            'dispatch_date' => now()->toDateTimeString(),
            'delivery_date' => now()->toDateTimeString(),
            'salesperson_id' => $salesperson->id,
            'delivery_person_id' => $deliveryPerson->id,
            'order_status_id' => $orderStatus->id,
        ];

        // Send POST request to create order
        $response = $this->postJson('/api/orders', $data);

        // Assert the response
        $response->assertStatus(201);

        // Verify that the mock was called
        Mockery::close();
    }
}
