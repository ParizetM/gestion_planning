<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/users/{user}', [UserController::class, 'show']);
Route::resource('absences', AbsenceController::class);
Route::resource('motifs', MotifController::class);
