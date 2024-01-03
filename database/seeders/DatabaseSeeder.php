<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\About;
use App\Models\AskedQuestions;
use App\Models\Blogs;
use App\Models\Category;
use App\Models\CensusPopulation;
use App\Models\GalleryActivities;
use App\Models\Images;
use App\Models\TemporaryImage;
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
        About::factory(1)->create();
        Category::factory(3)->create();
        Images::factory(3)->create();
        TemporaryImage::factory(2)->create();
        CensusPopulation::factory(1)->create();
        AskedQuestions::factory(5)->create();
        Blogs::factory(3)->create();
        GalleryActivities::factory(20)->create();
    }
}
