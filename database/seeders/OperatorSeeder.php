<?php

namespace Database\Seeders;

use App\Models\Operator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Operator::create([
            'full_name' => 'Operator 1',
            'phone_number' => '08123456789',
            'type' => 'Akademik',
        ]);

        Operator::create([
            'full_name' => 'Operator 2',
            'phone_number' => '08123456789',
            'type' => 'Kemahasiswaan',
        ]);

        Operator::create([
            'full_name' => 'Operator 3',
            'phone_number' => '08123456789',
            'type' => 'Fasilitas',
        ]);

        Operator::create([
            'full_name' => 'Operator 4',
            'phone_number' => '08123456789',
            'type' => 'Pelecehan',
        ]);
    }
}
