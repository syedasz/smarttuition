<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tuition;
use App\Models\User;

class TuitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ensure a tutor exists
        $tutor = User::firstOrCreate(
            ['email' => 'tutor@example.com'],
            [
                'name' => 'John Doe',
                'password' => bcrypt('password'),
                'is_tutor' => true // Ensure this field exists in your User model
            ]
        );

        // Seed tuition data
        Tuition::create([
            'subject' => 'Mathematics',
            'fee' => 50,
            'category' => 'Upper Secondary',
            'max_students' => 10,
            'tutor_id' => $tutor->id,
            'image_url' => null,
            'notes' => 'This class focuses on algebra and trigonometry concepts.'
        ]);
    }
}