<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'full_name' => 'Student 1',
            'phone_number' => '08123456789',
            'study_program' => 'Technic Informatica',
            'nim' => '2301020081',
        ]);

        Student::create([
            'full_name' => 'Student 2',
            'phone_number' => '08123456789',
            'study_program' => 'Technic',
            'nim' => '2301020082',
        ]);
    }
}
