<?php

use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProdiRegistrationController;
use App\Http\Controllers\SmaRegistrationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SMAController;
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
})->name('home');

Route::get('/pendaftaran-sma', [SMAController::class, 'create'])->name('pendaftaranSMA.index');
Route::post('/pendaftaran-sma', [SMAController::class, 'store'])->name('pendaftaranSMA.store');

Route::get('/pendaftaran-prodi', [ProdiController::class, 'create'])->name('pendaftaranProdi.index');
Route::post('/pendaftaran-prodi', [ProdiController::class, 'store'])->name('pendaftaranProdi.store');