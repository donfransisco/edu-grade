<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    protected $model = Grade::class;

    public function definition(): array
    {
        $nilai = $this->faker->randomFloat(2, 0, 100);

        return [
            'student_id' => Student::factory(),
            'course_id' => Course::factory(),
            'nilai' => $nilai,
            'grade' => Grade::calculateGrade($nilai),
            'semester' => $this->faker->numberBetween(1, 8),
            'tahun_akademik' => $this->faker->randomElement(['2023/2024', '2024/2025', '2025/2026']),
        ];
    }
}
