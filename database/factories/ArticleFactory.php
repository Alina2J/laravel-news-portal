<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'name' => $this->faker->sentence(5),
            'shortDesc' => $this->faker->paragraph(1),
            'desc' => $this->faker->text(500),
            // Указываем картинки, которые у нас уже лежат в public/images
            'preview_image' => 'preview.jpg',
            'full_image' => 'full.jpeg',
        ];
    }
}
