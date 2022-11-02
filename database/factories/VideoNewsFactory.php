<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\News;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VideoNewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $news = News::where('types','=','video')->get()->random(1)->toArray();
        return [
            'is_active' => fake()->randomElement(['0', '1']),
            'title' => $this->faker->sentence(5),
            'url' => $this->faker->slug(),
            'video' =>'<iframe width="560" height="315" src="https://www.youtube.com/embed/vVn9qDZJZ2w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            'copyright' => $this->faker->text(),
            'news_id' => $news[0]['id'],
            'order_by_no' => random_int(1, 100),
        ];
    }
}
