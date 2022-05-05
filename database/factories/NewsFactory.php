<?php

namespace Database\Factories;

use App\Models\NewsType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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
            'title' => $this->faker->title(),
            'short_description' => Str::substr($this->faker->text(), 0, 200),
            'description' => $this->faker->text(),
            'view' => rand(0,100000),
            'news_types_id' => NewsType::inRandomOrder()->get()->first()->id,
            'image' => $this->faker->image(Storage::disk('public')->path('images/news'), 300, 300)

        ];
    }
}
