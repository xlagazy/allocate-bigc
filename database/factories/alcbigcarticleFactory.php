<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\alcbigcarticle>
 */
class alcbigcarticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'article_no'=>fake()->name(),
            'price'=>fake()->numberBetween(10, 20),
            'pack_size'=>fake()->text(),
            'status'=>rand(0, 1)
        ];
    }
}
