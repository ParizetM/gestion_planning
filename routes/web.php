<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('locale')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::resource('users', UserController::class);
        Route::get('/users/{user}', [UserController::class, 'show']);

        Route::middleware('permission:admin')->group(function () {
            Route::get('/absences/create', [AbsenceController::class, 'create'])->name('absences.create');
            Route::post('/absences', [AbsenceController::class, 'store'])->name('absences.store');
            Route::get('/motifs/create', [MotifController::class, 'create'])->name('motifs.create');
            Route::post('/motifs', [MotifController::class, 'store'])->name('motifs.store');
            Route::delete('/motifs/{motif}', [MotifController::class, 'destroy'])->name('motifs.destroy');
            Route::delete('/absences/{absence}', [AbsenceController::class, 'destroy'])->name('absences.destroy');
            Route::get('/absences/{absence}/edit', [AbsenceController::class, 'edit'])->name('absences.edit');
            Route::put('/absences/{absence}', [AbsenceController::class, 'update'])->name('absences.update');
        });
    });
    Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
    Route::get('/absences/{absence}', [AbsenceController::class, 'show'])->name('absences.show');

    Route::middleware(['auth', 'permission:admin,salarie'])->group(function () {
        Route::get('/motifs/{motif}/edit', [MotifController::class, 'edit'])->name('motifs.edit');
        Route::put('/motifs/{motif}', [MotifController::class, 'update'])->name('motifs.update');
    });
    Route::get('/motifs', [MotifController::class, 'index'])->name('motifs.index');
    Route::get('/motifs/{motif}', [MotifController::class, 'show'])->name('motifs.show');
    Route::get('change-language/{locale}', [App\Http\Controllers\LanguageController::class, 'changeLanguage'])->name('language.change');

    require __DIR__.'/auth.php';
});
