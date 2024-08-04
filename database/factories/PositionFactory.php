<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Position;

class PositionFactory extends Factory
{
    protected $model = Position::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
