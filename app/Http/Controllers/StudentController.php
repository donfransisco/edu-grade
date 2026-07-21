<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('program_studi', 'like', "%{$search}%");
            });
        }

        if ($programStudi = $request->input('program_studi')) {
            $query->where('program_studi', $programStudi);
        }

        if ($angkatan = $request->input('angkatan')) {
            $query->where('angkatan', $angkatan);
        }

        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');

        $allowedSorts = ['nim', 'nama', 'program_studi', 'angkatan', 'created_at'];

        if (! in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        $students = $query->orderBy($sortBy, $sortDir)->paginate(15)->withQueryString();

        return view('students.index', compact('students'));
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('students', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Student $student): View
    {
        $student->load('grades.course');

        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($student->foto) {
                Storage::disk('public')->delete($student->foto);
            }
            $data['foto'] = $request->file('foto')->store('students', 'public');
        }

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        if ($student->foto) {
            Storage::disk('public')->delete($student->foto);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
