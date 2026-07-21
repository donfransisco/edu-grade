<?php

namespace Database\Factories;

use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class LecturerFactory extends Factory
{
    protected $model = Lecturer::class;

    public function definition(): array
    {
        return [
            'nidn' => $this->faker->unique()->numerify('##########'),
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'telepon' => $this->faker->optional(0.7)->numerify('08##########'),
            'program_studi' => $this->faker->randomElement(Lecturer::programStudiOptions()),
        ];
    }
}
