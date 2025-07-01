<?php

namespace Database\Seeders;

use App\Models\CoverType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoverTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoverType::insert([
            ['name' => 'front'],
            ['name' => 'back'],
        ]);
    }
}
