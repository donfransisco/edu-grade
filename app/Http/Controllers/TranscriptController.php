<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TranscriptController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        if ($programStudi = $request->input('program_studi')) {
            $query->where('program_studi', $programStudi);
        }

        $students = $query->orderBy('nama')->paginate(15)->withQueryString();

        return view('transcripts.index', compact('students'));
    }

    public function show(Student $student): View
    {
        $student->load([
            'grades.course' => fn ($q) => $q->orderBy('semester'),
        ]);

        $allSemesterGrades = $student->grades->groupBy('semester')->sortKeys();

        $semesterSummaries = $allSemesterGrades->map(function ($grades, $semester) {
            $totalSks = $grades->sum('course.sks');
            $weightedPoints = $grades->sum(function (Grade $g) {
                return $g->gpa * $g->course->sks;
            });

            return [
                'semester' => $semester,
                'grades' => $grades,
                'total_sks' => $totalSks,
                'ip_semester' => $totalSks > 0 ? round($weightedPoints / $totalSks, 2) : 0,
                'grade_count' => $grades->count(),
            ];
        });

        $totalSks = $student->grades->sum('course.sks');
        $totalWeightedPoints = $student->grades->sum(function (Grade $g) {
            return $g->gpa * $g->course->sks;
        });
        $ipk = $totalSks > 0 ? round($totalWeightedPoints / $totalSks, 2) : 0;

        return view('transcripts.show', compact('student', 'semesterSummaries', 'totalSks', 'ipk'));
    }
}
