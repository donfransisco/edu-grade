<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Lecturer;
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

    public function test_courses_index_renders(): void
    {
        $lecturer = Lecturer::factory()->create();
        Course::factory()->count(5)->create(['lecturer_id' => $lecturer->id]);
        $response = $this->get(route('courses.index'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }

    public function test_courses_create_renders(): void
    {
        Lecturer::factory()->count(3)->create();
        $response = $this->get(route('courses.create'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }

    public function test_courses_show_renders(): void
    {
        $lecturer = Lecturer::factory()->create();
        $course = Course::factory()->create(['lecturer_id' => $lecturer->id]);
        $response = $this->get(route('courses.show', $course));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }

    public function test_grades_index_renders(): void
    {
        $student = Student::factory()->create();
        $lecturer = Lecturer::factory()->create();
        $course = Course::factory()->create(['lecturer_id' => $lecturer->id]);
        $semesters = ['2023/2024', '2023/2025', '2024/2026', '2025/2026', '2025/2027'];
        foreach (range(1, 5) as $i) {
            Grade::factory()->create([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'semester' => $i,
                'tahun_akademik' => $semesters[$i - 1],
            ]);
        }
        $response = $this->get(route('grades.index'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }

    public function test_grades_create_renders(): void
    {
        $lecturer = Lecturer::factory()->create();
        Student::factory()->count(3)->create();
        Course::factory()->count(3)->create(['lecturer_id' => $lecturer->id]);
        $response = $this->get(route('grades.create'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }

    public function test_dashboard_renders(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
        $response->assertDontSee('ErrorException');
    }

    public function test_transcripts_index_renders(): void
    {
        Student::factory()->count(5)->create();
        $response = $this->get(route('transcripts.index'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }

    public function test_transcripts_show_renders(): void
    {
        $student = Student::factory()->create();
        $lecturer = Lecturer::factory()->create();
        $course = Course::factory()->create(['lecturer_id' => $lecturer->id]);
        Grade::factory()->count(3)->create([
            'student_id' => $student->id,
            'course_id' => $course->id,
        ]);
        $response = $this->get(route('transcripts.show', $student));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }

    public function test_reports_index_renders(): void
    {
        $student = Student::factory()->create();
        $lecturer = Lecturer::factory()->create();
        $course = Course::factory()->create(['lecturer_id' => $lecturer->id]);
        Grade::factory()->count(5)->create([
            'student_id' => $student->id,
            'course_id' => $course->id,
        ]);
        $response = $this->get(route('reports.index'));
        $response->assertStatus(200);
        $response->assertDontSee('Undefined variable');
    }

    public function test_reports_export_csv(): void
    {
        $student = Student::factory()->create();
        $lecturer = Lecturer::factory()->create();
        $course = Course::factory()->create(['lecturer_id' => $lecturer->id]);
        Grade::factory()->count(3)->create([
            'student_id' => $student->id,
            'course_id' => $course->id,
        ]);
        $response = $this->get(route('reports.export'));
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
    }
}
