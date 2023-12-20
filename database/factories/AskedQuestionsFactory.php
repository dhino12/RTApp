<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AskedQuestions>
 */
class AskedQuestionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2,8)),
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                ->map(fn ($paragraph) => "<p>" . $paragraph ."</p>")
                ->implode(""),
        ];
    }
}
