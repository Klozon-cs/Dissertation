<?php

namespace Database\Seeders;

use App\Models\Schoolday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schoolday::factory(4)->create();
    }
}
