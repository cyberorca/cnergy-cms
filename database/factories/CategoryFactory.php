<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition()
    {
        return [
            'category' => $this->faker->name(),
            'common' => $this->faker->name(),
            'parent_id' => $this->faker->randomElement([random_int(0, 50), null]),
            'slug' => $this->faker->slug(),
            'types' => '["news", "video", "photonews"]',
            'created_by' => User::first()->uuid,
        ];
    }
}
