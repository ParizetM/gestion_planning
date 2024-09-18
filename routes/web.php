<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
Route::get('/absences/{absence}', [AbsenceController::class, 'show'])->name('absences.show');



