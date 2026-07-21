<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GradeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Grade::with(['student', 'course']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', fn ($sq) => $sq->where('nama', 'like', "%{$search}%")->orWhere('nim', 'like', "%{$search}%"))
                    ->orWhereHas('course', fn ($cq) => $cq->where('nama', 'like', "%{$search}%")->orWhere('kode', 'like', "%{$search}%"));
            });
        }

        if ($courseId = $request->input('course_id')) {
            $query->where('course_id', $courseId);
        }

        if ($semester = $request->input('semester')) {
            $query->where('semester', $semester);
        }

        if ($tahunAkademik = $request->input('tahun_akademik')) {
            $query->where('tahun_akademik', $tahunAkademik);
        }

        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');

        $allowedSorts = ['nilai', 'grade', 'semester', 'tahun_akademik', 'created_at'];

        if (! in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        $grades = $query->orderBy($sortBy, $sortDir)->paginate(15)->withQueryString();
        $courses = Course::orderBy('nama')->get();

        $tahunAkademiks = Grade::select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'desc')
            ->pluck('tahun_akademik');

        return view('grades.index', compact('grades', 'courses', 'tahunAkademiks'));
    }

    public function create(): View
    {
        $students = Student::orderBy('nama')->get();
        $courses = Course::with('lecturer')->orderBy('nama')->get();

        return view('grades.create', compact('students', 'courses'));
    }

    public function store(StoreGradeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['grade'] = Grade::calculateGrade($data['nilai']);

        Grade::create($data);

        return redirect()->route('grades.index')->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function edit(Grade $grade): View
    {
        $students = Student::orderBy('nama')->get();
        $courses = Course::with('lecturer')->orderBy('nama')->get();

        return view('grades.edit', compact('grade', 'students', 'courses'));
    }

    public function update(UpdateGradeRequest $request, Grade $grade): RedirectResponse
    {
        $data = $request->validated();
        $data['grade'] = Grade::calculateGrade($data['nilai']);

        $grade->update($data);

        return redirect()->route('grades.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy(Grade $grade): RedirectResponse
    {
        $grade->delete();

        return redirect()->route('grades.index')->with('success', 'Nilai berhasil dihapus.');
    }
}
