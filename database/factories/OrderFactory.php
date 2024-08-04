<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [            
            'order_number' => $this->faker->unique()->word,
            'products' => $this->faker->text,
            'order_date' => $this->faker->dateTimeThisYear(),
            'receipt_date' => $this->faker->dateTimeThisYear(),
            'dispatch_date' => $this->faker->dateTimeThisYear(),
            'delivery_date' => $this->faker->dateTimeThisYear(),
            'salesperson_id' => User::factory(),
            'delivery_person_id' => User::factory(),
            'order_status_id' => OrderStatus::factory(),
        ];
    }
}
