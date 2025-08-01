<?php

namespace Database\Seeders; // Add this line

use App\Models\Qualification;
use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    public function run(): void
    {
        Qualification::create([
            'title' => 'Cookery NC II',
            'description' => 'Prepare hot and cold meals in commercial kitchens.',
            'assessment_fee' => 1500.00,
        ]);
        Qualification::create([
            'title' => 'EIM NC II',
            'description' => 'Install and maintain electrical wiring and lighting systems.',
            'assessment_fee' => 1200.00,
        ]);
    }
}