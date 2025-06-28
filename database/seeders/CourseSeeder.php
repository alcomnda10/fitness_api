<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::insert([
            [
                'title' => 'Full Body Workout',
                'description' => 'Get in shape with this intense full body program.',
                'image' => 'https://via.placeholder.com/300x200?text=Workout+1',
                'price' => 49.99,
            ],
            [
                'title' => 'Yoga for Beginners',
                'description' => 'A calming course designed for new yoga practitioners.',
                'image' => 'https://via.placeholder.com/300x200?text=Yoga',
                'price' => 29.99,
            ],
            [
                'title' => 'Advanced Weightlifting',
                'description' => 'Push your limits with this advanced lifting program.',
                'image' => 'https://via.placeholder.com/300x200?text=Weightlifting',
                'price' => 59.99,
            ],
            [
                'title' => 'Home Cardio Blast',
                'description' => 'No equipment needed. Burn fat from your living room.',
                'image' => 'https://via.placeholder.com/300x200?text=Cardio',
                'price' => 19.99,
            ],
            [
                'title' => 'Nutrition & Diet Plan',
                'description' => 'Learn how to fuel your body for success.',
                'image' => 'https://via.placeholder.com/300x200?text=Nutrition',
                'price' => 39.99,
            ],
        ]);
    }
}
