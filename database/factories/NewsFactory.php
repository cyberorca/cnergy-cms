<?php

namespace Database\Factories;

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
            'title' => $this->faker->sentence(20),
            'url' => $this->faker->url(),
            'content' => $this->faker->text(),
            'synopsis' => $this->faker->text(),
            'image' => $this->faker->image(),
            'video' => 'video.mp4',
            'published_at' => now(),
            'published_by' => $this->faker->name(),
            'created_by' => $this->faker->name(),
            'updated_by' => $this->faker->name(),
            'deleted_by' => $this->faker->name(),
        ];
    }
}
