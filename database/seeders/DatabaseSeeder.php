<?php

namespace Database\Seeders; // THIS LINE IS CRUCIAL

use Illuminate\Database\Seeder;
use App\Models\User; // Add if using User factory

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            QualificationSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}