<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tags' => $this->faker->userName(),
            'is_Active' => fake()->randomElement(['0', '1']),
            'slug' => fake()->slug(),
            'created_by' => '0a351387-e1c2-43fb-a563-4abedc3cd558',
            'created_at' => now(),
        ];
    }
}
