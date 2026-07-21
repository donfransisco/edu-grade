<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        $kode = strtoupper($this->faker->bothify('???###'));

        return [
            'lecturer_id' => Lecturer::factory(),
            'kode' => $this->faker->unique()->passthrough($kode),
            'nama' => $this->faker->words(3, true),
            'sks' => $this->faker->numberBetween(1, 4),
            'semester' => $this->faker->numberBetween(1, 8),
        ];
    }
}
