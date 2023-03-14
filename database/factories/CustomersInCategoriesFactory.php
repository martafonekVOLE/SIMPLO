<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomersInCategories>
 */
class CustomersInCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customers_id' => $this->faker->numberBetween(1, 5),
            'categories_id' => $this->faker->unique()->numberBetween(1, 5)
        ];
    }
}
