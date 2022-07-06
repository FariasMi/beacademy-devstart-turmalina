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
            'name'=>$this->faker->name(),
            'quantity'=>$this->faker->randomNumber(),
            'description'=>$this->faker->randomLetter(),
            'price'=>$this->faker->randomFloat(2,8,10),
            'photo'=>$this->faker->randomLetter(),
        ];
    }
}
