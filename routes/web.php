<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\HasilController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Tambahkan route untuk home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::resource('criteria', CriteriaController::class)->parameters([
        'criteria' => 'criterion'
    ]);
    Route::resource('alternative', AlternativeController::class)->parameters([
        'alternative' => 'alternative'  
    ]);
     Route::resource('penilaian', PenilaianController::class)->parameters([
        'penilaian' => 'alternative'
    ]);
    Route::get('/hasil', [HasilController::class, 'index'])->name('hasil.index');
 });