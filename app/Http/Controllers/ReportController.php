<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = Grade::with(['student', 'course', 'course.lecturer']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', fn ($sq) => $sq->where('nama', 'like', "%{$search}%")->orWhere('nim', 'like', "%{$search}%"))
                    ->orWhereHas('course', fn ($cq) => $cq->where('nama', 'like', "%{$search}%")->orWhere('kode', 'like', "%{$search}%"));
            });
        }

        if ($semester = $request->input('semester')) {
            $query->where('semester', $semester);
        }

        if ($tahunAkademik = $request->input('tahun_akademik')) {
            $query->where('tahun_akademik', $tahunAkademik);
        }

        if ($programStudi = $request->input('program_studi')) {
            $query->whereHas('student', fn ($sq) => $sq->where('program_studi', $programStudi));
        }

        if ($courseId = $request->input('course_id')) {
            $query->where('course_id', $courseId);
        }

        $grades = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        $allFilteredGrades = Grade::query()
            ->when($request->input('semester'), fn ($q, $v) => $q->where('semester', $v))
            ->when($request->input('tahun_akademik'), fn ($q, $v) => $q->where('tahun_akademik', $v))
            ->when($request->input('program_studi'), fn ($q, $v) => $q->whereHas('student', fn ($sq) => $sq->where('program_studi', $v)))
            ->when($request->input('course_id'), fn ($q, $v) => $q->where('course_id', $v))
            ->when($request->input('search'), fn ($q, $s) => $q->where(function ($wq) use ($s) {
                $wq->whereHas('student', fn ($sq) => $sq->where('nama', 'like', "%{$s}%")->orWhere('nim', 'like', "%{$s}%"))
                    ->orWhereHas('course', fn ($cq) => $cq->where('nama', 'like', "%{$s}%")->orWhere('kode', 'like', "%{$s}%"));
            }))
            ->get();

        $stats = [
            'total' => $allFilteredGrades->count(),
            'avg' => $allFilteredGrades->avg('nilai') ?? 0,
            'max' => $allFilteredGrades->max('nilai') ?? 0,
            'min' => $allFilteredGrades->min('nilai') ?? 0,
            'distribution' => [
                'A' => $allFilteredGrades->where('grade', 'A')->count(),
                'B' => $allFilteredGrades->where('grade', 'B')->count(),
                'C' => $allFilteredGrades->where('grade', 'C')->count(),
                'D' => $allFilteredGrades->where('grade', 'D')->count(),
                'E' => $allFilteredGrades->where('grade', 'E')->count(),
            ],
        ];

        $courses = Course::orderBy('nama')->get();
        $tahunAkademiks = Grade::select('tahun_akademik')->distinct()->orderBy('tahun_akademik', 'desc')->pluck('tahun_akademik');
        $programStudiOptions = Student::programStudiOptions();

        return view('reports.index', compact('grades', 'stats', 'courses', 'tahunAkademiks', 'programStudiOptions'));
    }

    public function export(Request $request): StreamedResponse
    {
        $query = Grade::with(['student', 'course', 'course.lecturer']);

        if ($semester = $request->input('semester')) {
            $query->where('semester', $semester);
        }
        if ($tahunAkademik = $request->input('tahun_akademik')) {
            $query->where('tahun_akademik', $tahunAkademik);
        }
        if ($programStudi = $request->input('program_studi')) {
            $query->whereHas('student', fn ($sq) => $sq->where('program_studi', $programStudi));
        }
        if ($courseId = $request->input('course_id')) {
            $query->where('course_id', $courseId);
        }

        $grades = $query->orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="laporan_nilai_'.date('Y-m-d').'.csv"',
        ];

        $callback = function () use ($grades) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['NIM', 'Nama Mahasiswa', 'Program Studi', 'Kode MK', 'Mata Kuliah', 'SKS', 'Semester', 'Tahun Akademik', 'Nilai', 'Grade', 'IPK']);
            foreach ($grades as $grade) {
                $totalSks = $grade->student->grades->sum('course.sks');
                $totalWeighted = $grade->student->grades->sum(fn (Grade $g) => $g->gpa * $g->course->sks);
                $ipk = $totalSks > 0 ? round($totalWeighted / $totalSks, 2) : 0;

                fputcsv($handle, [
                    $grade->student->nim,
                    $grade->student->nama,
                    $grade->student->program_studi,
                    $grade->course->kode,
                    $grade->course->nama,
                    $grade->course->sks,
                    $grade->semester,
                    $grade->tahun_akademik,
                    $grade->nilai,
                    $grade->grade,
                    $ipk,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
