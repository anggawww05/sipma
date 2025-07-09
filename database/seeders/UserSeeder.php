<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('admin1'),
            'admin_id' => 1,
        ]);

        User::create([
            'username' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('admin2'),
            'admin_id' => 2,
        ]);

        User::create([
            'username' => 'operator1',
            'email' => 'operator1@gmail.com',
            'password' => bcrypt('operator1'),
            'operator_id' => 1,
        ]);

        User::create([
            'username' => 'operator2',
            'email' => 'operator2@gmail.com',
            'password' => bcrypt('operator2'),
            'operator_id' => 2,
        ]);

        User::create([
            'username' => 'operator3',
            'email' => 'operator3@gmail.com',
            'password' => bcrypt('operator3'),
            'operator_id' => 3,
        ]);

        User::create([
            'username' => 'operator4',
            'email' => 'operator4@gmail.com',
            'password' => bcrypt('operator4'),
            'operator_id' => 4,
        ]);

        User::create([
            'username' => 'student1',
            'email' => 'student1@gmail.com',
            'password' => bcrypt('student1'),
            'student_id' => 1,
        ]);

        User::create([
            'username' => 'student2',
            'email' => 'student2@gmail.com',
            'password' => bcrypt('student2'),
            'student_id' => 2,
        ]);
    }
}
