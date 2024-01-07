<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->sentence(mt_rand(2, 4)),
            "slug" => $this->faker->slug(mt_rand(2, 4)),
            "body" => collect($this->faker->paragraphs(mt_rand(5, 10)))
                ->map(fn ($paragraph) => "<p>" . $paragraph ."</p>")
                ->implode(""),
            "user_id" => mt_rand(1,2),
            "category_id" => mt_rand(1,2),
        ];
    }
}
