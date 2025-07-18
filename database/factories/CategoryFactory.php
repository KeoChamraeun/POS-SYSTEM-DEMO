<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

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
            'Coffee & Tea',
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
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'user_id' => User::inRandomOrder()->first()?->id ?? 1, // fallback to user_id = 1
        ];
    }
}
