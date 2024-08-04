<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [ 
            'name' => $this->faker->name, 
            'email' => $this->faker->unique()->safeEmail, 
            'password' => Hash::make('password123'),
            'role_id' => $this->faker->numberBetween(1, 4), 
            'position_id' => $this->faker->numberBetween(1, 3),
            'phone' => $this->faker->phoneNumber, 
            'code' => $this->faker->unique()->bothify('EMP###'), 
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
