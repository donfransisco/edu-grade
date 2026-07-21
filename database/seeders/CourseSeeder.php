<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $lecturerIds = Lecturer::pluck('id');

        Course::factory()
            ->count(50)
            ->sequence(fn () => ['lecturer_id' => $lecturerIds->random()])
            ->create();
    }
}
