<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
Route::get('/classrooms/{classroom}/students', [StudentController::class, 'studentsByClass'])->name('students.by-class');
Route::post('/students/register-subject', [StudentController::class, 'registerSubject'])->name('students.register-subject');
