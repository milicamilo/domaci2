<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name'=> $this->faker->name(),
            'description'=> $this->faker->sentence(),
            'price'=> $this->faker->randomFloat(2,10,40),
            'category_id'=> Category::factory(),
            'user_id'=> User::factory(),
            'ingredients'=> $this->faker->sentence()
        ];
    }
}
