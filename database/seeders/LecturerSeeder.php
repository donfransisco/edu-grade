<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    public function run(): void
    {
        Lecturer::factory()->count(30)->create();
    }
}
