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
            'title' => $this->faker->sentence(5),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->text(),
            'description' => $this->faker->text(),
            'synopsis' => $this->faker->text(),
            'types' => fake()->randomElement(["news", "video", "photonews"]),
            'image' => null,
            'published_at' => now(),
            'published_by' => User::first()->uuid,
            'created_at' => now(),
            'created_by' => User::first()->uuid,
            'updated_at' => null,
            'updated_by' => null,
            'deleted_at' => null,
            'deleted_by' => null,
            'category_id' => random_int(1, 50),
            'is_published' => fake()->randomElement(['0', '1']),
            'keywords' => $this->faker->slug()
        ];
    }
}
