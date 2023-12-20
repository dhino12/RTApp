<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Images>
 */
class ImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(mt_rand(2,8)),
            'title' => $this->faker->sentence(mt_rand(2,8)),
            'description' => $this->faker->sentence(mt_rand(5, 6)),
            'users_id' => mt_rand(1,3),
            'gallery_activities_id' => mt_rand(1,2),
            'blogs_id' => mt_rand(1,2),
        ];
    }
}
