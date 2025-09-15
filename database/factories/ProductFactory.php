<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'code' => strtoupper($this->faker->bothify('PLANT###')),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->numberBetween(10, 100),
            'image' => 'https://picsum.photos/200/300?random=' . $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}
