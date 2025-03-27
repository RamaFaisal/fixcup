<?php

use App\Http\Controllers\ProdiRegistrationController;
use App\Http\Controllers\SmaRegistrationController;
use App\Http\Controllers\RegistrationController;
use App\Livewire\RegistrationForm;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/pendaftaransma', RegistrationForm::class)->name('pendaftaranSMA');

Route::prefix('pendaftaran-sma')->name('pendaftaranSMA.')->group(function () {
    Route::get('/', [SmaRegistrationController::class, 'index'])->name('index');
    Route::post('/step/{step}', [SmaRegistrationController::class, 'handleStep'])->name('step');
    Route::post('/submit', [SmaRegistrationController::class, 'submit'])->name('submit');
});

Route::prefix('pendaftaran-prodi')->name('pendaftaranProdi.')->group(function () {
    Route::get('/', [ProdiRegistrationController::class, 'index'])->name('index');
    Route::post('/step/{step}', [ProdiRegistrationController::class, 'handleStep'])->name('step');
    Route::post('/submit', [ProdiRegistrationController::class, 'submit'])->name('submit');
});
