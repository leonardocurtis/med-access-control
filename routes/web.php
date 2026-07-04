<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->group(function () {

        Route::resource('users', UserController::class)->except('show');
        Route::resource('permissions', PermissionController::class)->except('show');
    });

    Route::get('/hospital-sectors', [ModuleController::class, 'hospitalSectors'])
        ->middleware('permission:access-hospital-sectors')
        ->name('modules.hospital-sectors');

    Route::get('/medical-specialties', [ModuleController::class, 'medicalSpecialties'])
        ->middleware('permission:access-medical-specialties')
        ->name('modules.medical-specialties');

    Route::get('/equipment', [ModuleController::class, 'equipment'])
        ->middleware('permission:access-equipment')
        ->name('modules.equipment');

    Route::get('/care-units', [ModuleController::class, 'careUnits'])
        ->middleware('permission:access-care-units')
        ->name('modules.care-units');
});

require __DIR__.'/auth.php';
