<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        // PlanSeeder::class,
        // ]);
        //     $this->call([
        //         TestimonialSeeder::class,
        //     ]);
        // 
        // $this->call([
        //     FeatureSeeder::class,
        // ]);

        $this->call([
            CourseSeeder::class,
        ]);
    }
}
