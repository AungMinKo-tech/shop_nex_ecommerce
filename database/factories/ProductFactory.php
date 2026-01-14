<?php

namespace Database\Factories;

use App\Models\Category;
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
        return [
            'name' => $this->faker->unique()->words(3, true),
            'price' => (string) $this->faker->randomFloat(2, 10, 2000),  // Cast to string to match your schema
            'photo' => 'https://placehold.co/600x400?text=Product',
            'description' => $this->faker->sentence(),
            'detail' => $this->faker->paragraphs(3, true),
            'stock' => random_int(1, 30),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
        ];
    }
}
