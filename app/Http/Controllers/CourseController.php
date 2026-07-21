<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(Request $request): View
    {
        $query = Course::with('lecturer');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        if ($lecturerId = $request->input('lecturer_id')) {
            $query->where('lecturer_id', $lecturerId);
        }

        if ($semester = $request->input('semester')) {
            $query->where('semester', $semester);
        }

        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');

        $allowedSorts = ['kode', 'nama', 'sks', 'semester', 'created_at'];

        if (! in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        $courses = $query->orderBy($sortBy, $sortDir)->paginate(15)->withQueryString();
        $lecturers = Lecturer::orderBy('nama')->get();

        return view('courses.index', compact('courses', 'lecturers'));
    }

    public function create(): View
    {
        $lecturers = Lecturer::orderBy('nama')->get();

        return view('courses.create', compact('lecturers'));
    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        Course::create($request->validated());

        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function show(Course $course): View
    {
        $course->load('lecturer', 'grades.student');

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course): View
    {
        $lecturers = Lecturer::orderBy('nama')->get();

        return view('courses.edit', compact('course', 'lecturers'));
    }

    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $course->update($request->validated());

        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
