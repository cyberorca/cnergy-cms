<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhotoNews>
 */
class PhotoNewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'is_active' => fake()->randomElement(['0', '1']),
            'title' => $this->faker->sentence(5),
            'url' => $this->faker->slug(),
            'image' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'keywords' => $this->faker->text(),
            'copyright' => $this->faker->text(),
            'news_id' => random_int(1, 100),
            'order_by_no' => random_int(1, 100),
            'created_at' => now(),
            'created_by' => User::first()->uuid,
            'updated_at' => null,
            'updated_by' => null,
            'deleted_at' => null,
            'deleted_by' => null
        ];
    }
}
