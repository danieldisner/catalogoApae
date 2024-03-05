<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productName = $this->faker->unique()->words(3, true);
        $price = $this->faker->randomFloat(2, 10, 500);
        $description = $this->faker->paragraph(3);

        return [
            'name' => ucfirst($productName),
            'price' => $price,
            'description' => $description,
        ];
    }
}
