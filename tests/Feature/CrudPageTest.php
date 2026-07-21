<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrudPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_students_index_renders(): void
    {
        Student::factory()->count(20)->create();
        $response = $this->get(route('students.index'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
        $response->assertDontSee('ErrorException');
    }

    public function test_students_create_renders(): void
    {
        $response = $this->get(route('students.create'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }

    public function test_lecturers_index_renders(): void
    {
        $response = $this->get(route('lecturers.index'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }

    public function test_lecturers_create_renders(): void
    {
        $response = $this->get(route('lecturers.create'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }
}
