<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $programStudi = $this->faker->randomElement(Student::programStudiOptions());
        $angkatan = $this->faker->numberBetween(2018, date('Y'));

        return [
            'nim' => $this->faker->unique()->numerify('####'.str_pad($angkatan, 2, '0', STR_PAD_LEFT).'####'),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'program_studi' => $programStudi,
            'angkatan' => $angkatan,
            'email' => $this->faker->unique()->safeEmail(),
            'telepon' => $this->faker->optional(0.7)->numerify('08##########'),
            'alamat' => $this->faker->optional(0.6)->address(),
            'foto' => null,
        ];
    }
}
