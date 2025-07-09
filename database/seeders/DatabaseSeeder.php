<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(OperatorSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
