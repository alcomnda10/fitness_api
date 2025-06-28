<?php
/*
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'price' => '29',
                'period' => 'month',
                'description' => 'Perfect for beginners',
                'highlighted' => false,
                'features' => json_encode([
                    'Access to basic workout plans',
                    'Basic health tracking',
                    'Community forum access',
                    'Email support'
                ]),
                'button_text' => 'Start Basic'
            ],
            [
                'name' => 'Pro',
                'price' => '49',
                'period' => 'month',
                'description' => 'Most popular choice',
                'highlighted' => true,
                'features' => json_encode([
                    'All Basic features',
                    'Advanced workout plans',
                    'Personalized nutrition guide',
                    'Priority support',
                    'Progress analytics'
                ]),
                'button_text' => 'Go Pro'
            ],
            [
                'name' => 'Elite',
                'price' => '99',
                'period' => 'month',
                'description' => 'For serious athletes',
                'highlighted' => false,
                'features' => json_encode([
                    'All Pro features',
                    '1-on-1 coaching sessions',
                    'Custom meal plans',
                    'Advanced performance metrics',
                    'Premium workshop access'
                ]),
                'button_text' => 'Get Elite'
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}*/