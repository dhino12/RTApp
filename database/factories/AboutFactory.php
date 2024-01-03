<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(mt_rand(2,8)),
            'misi' => $this->faker->sentence(mt_rand(2,8)),
            'visi' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                ->map(fn ($paragraph) => "<p>" . $paragraph ."</p>")
                ->implode(""),
            'user_id' => mt_rand(1,2),
        ];
    }
}
