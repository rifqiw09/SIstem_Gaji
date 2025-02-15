<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\GajiController;

/*
| Web Routes
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Jabatan Routes
    Route::resource('jabatan', JabatanController::class);
    
    // Karyawan Routes
    Route::resource('karyawan', KaryawanController::class);
    
    // Gaji Routes
    Route::resource('gaji', GajiController::class);
});
