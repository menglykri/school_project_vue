<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\TeacherController;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    // Teachers routes
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{teacher}/delete', [TeacherController::class, 'destroy'])->name('teachers.destroy');

    // Subjects routes 
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects');
    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}/delete', [SubjectController::class, 'destroy'])->name('subjects.destroy');

    // Classes routes
    Route::get('/classes', [ClassesController::class, 'index'])->name('classes');
    Route::get('/classes/create', [ClassesController::class, 'create'])->name('classes.create');
    Route::post('/classes', [ClassesController::class, 'store'])->name('classes.store');
    Route::get('/classes/{class}/edit', [ClassesController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{class}', [ClassesController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{class}/delete', [ClassesController::class, 'destroy'])->name('classes.destroy');
});

require __DIR__.'/settings.php';
