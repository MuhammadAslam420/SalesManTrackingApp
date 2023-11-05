<?php

namespace Database\Factories;

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
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraph,
            'stockIn' => $this->faker->randomNumber(),
            'qty' => $this->faker->randomNumber(),
            'sale_qty' => 0,
            'SKU' => 'ean'.$this->faker->unique()->numberBetween(1,1000),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'purchase_cost' => $this->faker->randomFloat(2, 1, 100),
            'sale_cost' => $this->faker->randomFloat(2, 1, 100),
            'discount_percentage' => $this->faker->optional(0.5)->randomFloat(2, 0, 100),
            'discount_on_qty' => $this->faker->optional(0.2)->randomNumber(),
            'discount_date_start' => $this->faker->optional(0.8)->date(),
            'discount_date_end' => $this->faker->optional(0.8)->date(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'sub_category_id' => $this->faker->numberBetween(2,20)
        ];
    }
}
