<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TranscriptController;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $stats = [
        'students' => Student::count(),
        'lecturers' => Lecturer::count(),
        'courses' => Course::count(),
        'avgGpa' => Grade::all()->map(fn (Grade $g) => $g->gpa)->avg(),
        'recentGrades' => Grade::with(['student', 'course'])
            ->latest()
            ->limit(5)
            ->get(),
    ];

    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('students', StudentController::class);
    Route::resource('lecturers', LecturerController::class);
    Route::resource('courses', CourseController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('grades', GradeController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::get('/transcripts', [TranscriptController::class, 'index'])->name('transcripts.index');
    Route::get('/transcripts/{student}', [TranscriptController::class, 'show'])->name('transcripts.show');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
});

require __DIR__.'/auth.php';
