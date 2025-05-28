<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Appetizers',
            'Main Course',
            'Desserts',
            'Beverages',
            'Salads',
            'Soups',
            'Snacks',
            'Bakery',
            'Seafood',
            'Vegetarian',
            'Vegan',
            'Breakfast',
            'Lunch',
            'Dinner',
            'Grill & Barbecue',
            'Frozen Foods',
            'Pasta & Noodles',
            'Pizza',
            'Healthy Options',
            'Fast Food'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($categories),
        ];
    }
}
