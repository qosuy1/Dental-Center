<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SpecialCaseController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ProfileController;


Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth']
    ],
    function () {

        Route::get('/', [IndexController::class, 'index'])->name('index');

        Route::resource('blogs', BlogController::class);

        Route::resource('special-cases', SpecialCaseController::class);

        Route::resource('departments', DepartmentController::class)->except('show');

        Route::resource('doctors', DoctorController::class)->except('show');

        Route::resource('users', UserController::class)->except('show');

        Route::resource('roles', RoleController::class);


        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    }
);

// Profile
Route::prefix('admin')
->middleware(['auth'])
->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


