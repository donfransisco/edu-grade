<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLecturerRequest;
use App\Http\Requests\UpdateLecturerRequest;
use App\Models\Lecturer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LecturerController extends Controller
{
    public function index(Request $request): View
    {
        $query = Lecturer::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nidn', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('program_studi', 'like', "%{$search}%");
            });
        }

        if ($programStudi = $request->input('program_studi')) {
            $query->where('program_studi', $programStudi);
        }

        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');

        $allowedSorts = ['nidn', 'nama', 'program_studi', 'created_at'];

        if (! in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        $lecturers = $query->orderBy($sortBy, $sortDir)->paginate(15)->withQueryString();

        return view('lecturers.index', compact('lecturers'));
    }

    public function create(): View
    {
        return view('lecturers.create');
    }

    public function store(StoreLecturerRequest $request): RedirectResponse
    {
        Lecturer::create($request->validated());

        return redirect()->route('lecturers.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function show(Lecturer $lecturer): View
    {
        $lecturer->load('courses');

        return view('lecturers.show', compact('lecturer'));
    }

    public function edit(Lecturer $lecturer): View
    {
        return view('lecturers.edit', compact('lecturer'));
    }

    public function update(UpdateLecturerRequest $request, Lecturer $lecturer): RedirectResponse
    {
        $lecturer->update($request->validated());

        return redirect()->route('lecturers.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Lecturer $lecturer): RedirectResponse
    {
        $lecturer->delete();

        return redirect()->route('lecturers.index')->with('success', 'Data dosen berhasil dihapus.');
    }
}
