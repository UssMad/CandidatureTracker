<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\EntretienController;
use App\Http\Controllers\FichierController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::redirect('/dashboard', '/candidatures')->name('dashboard');

    Route::resource('candidatures', CandidatureController::class);

    Route::get('archives', [ArchiveController::class, 'index'])->name('archives.index');
    Route::get('archives/{id}', [ArchiveController::class, 'show'])->name('archives.show');
    Route::patch('archives/{candidature}', [ArchiveController::class, 'restore'])->name('archives.restore');
    Route::delete('archives/{id}', [ArchiveController::class, 'forceDelete'])->name('archives.forceDelete');

    Route::resource('candidatures.entretiens', EntretienController::class)->only(['store', 'update', 'destroy']);

    Route::post('candidatures/{candidature}/fichiers', [FichierController::class, 'store'])->name('candidatures.fichiers.store');
});
