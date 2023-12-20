<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AskedQuestions;
use App\Models\Category;
use App\Models\CensusPopulation;
use App\Models\GalleryActivities;
use App\Models\Images;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Category::factory(3)->create();
        Images::factory(3)->create();
        CensusPopulation::factory(1)->create();
        AskedQuestions::factory(5)->create();
        GalleryActivities::factory(20)->create();
    }
}
