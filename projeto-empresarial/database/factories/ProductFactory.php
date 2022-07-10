<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> fake()-> name(),
            'quantity'=>fake()->numberBetween(0,1000),
            'description'=>fake()->text(100),
            'price'=>fake()->randomFloat(2,0,99999),
        ];
    }
}
