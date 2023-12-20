<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CensusPopulation>
 */
class CensusPopulationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "male" => mt_rand(200, 300),
            "female" => mt_rand(200,300),
            "total_population" => mt_rand(200,300),
            "total_family" => mt_rand(200,300),
            "user_id" => mt_rand(1,3)
        ];
    }
}
