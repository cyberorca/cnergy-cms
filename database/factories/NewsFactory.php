<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'is_headline' => fake()->randomElement(['0', '1']),
            'title' => $this->faker->sentence(20),
            'slug' => $this->faker->sentence(20),
            'content' => $this->faker->text(),
            'synopsis' => $this->faker->text(),
            'types' => fake()->randomElement(["news", "video", "photonews"]),
            'image' => null,
            'video' => null,
            'published_at' => now(),
            'published_by' => User::first()->uuid,
            'created_at' => now(),
            'created_by' => User::first()->uuid,
            'updated_at' => now(),
            'updated_by' => null,
            'deleted_at' => now(),
            'deleted_by' => null,
            'category_id' => random_int(1, 50),
        ];
    }
}
