<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Placeholder routes for sidebar navigation (will be replaced in later stages)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/students', fn () => redirect()->route('dashboard'))->name('students.index');
    Route::get('/dashboard/lecturers', fn () => redirect()->route('dashboard'))->name('lecturers.index');
    Route::get('/dashboard/courses', fn () => redirect()->route('dashboard'))->name('courses.index');
    Route::get('/dashboard/grades', fn () => redirect()->route('dashboard'))->name('grades.index');
    Route::get('/dashboard/transcripts', fn () => redirect()->route('dashboard'))->name('transcripts.index');
    Route::get('/dashboard/reports', fn () => redirect()->route('dashboard'))->name('reports.index');
});

require __DIR__.'/auth.php';
