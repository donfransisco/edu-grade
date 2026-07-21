<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $studentIds = Student::pluck('id');
        $courseIds = Course::pluck('id');

        $combos = [];
        $grades = [];

        for ($i = 0; $i < 1000; $i++) {
            $studentId = $studentIds->random();
            $courseId = $courseIds->random();
            $semester = fake()->numberBetween(1, 8);
            $tahunAkademik = fake()->randomElement(['2023/2024', '2024/2025', '2025/2026']);

            $key = "{$studentId}-{$courseId}-{$semester}-{$tahunAkademik}";

            if (isset($combos[$key])) {
                continue;
            }

            $combos[$key] = true;
            $nilai = fake()->randomFloat(2, 0, 100);

            $grades[] = [
                'student_id' => $studentId,
                'course_id' => $courseId,
                'nilai' => $nilai,
                'grade' => Grade::calculateGrade($nilai),
                'semester' => $semester,
                'tahun_akademik' => $tahunAkademik,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Grade::insert(array_slice($grades, 0, 1000));
    }
}
