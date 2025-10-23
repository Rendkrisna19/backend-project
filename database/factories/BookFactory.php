<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'  => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'isbn'   => $this->faker->unique()->isbn13(),
            'year'   => $this->faker->numberBetween(1990, 2025),
            'stock'  => $this->faker->numberBetween(0, 50),
        ];
    }
}
