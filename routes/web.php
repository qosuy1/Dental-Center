<?php

use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



require __DIR__ . '/auth.php';

require __DIR__ . '/dashboard.php';


// index
Route::get('/', [FrontendController::class, 'index'])->name('index');
// about us
Route::get('/about-us', [FrontendController::class , 'aboutUs'])->name('about');
// departments
Route::get('/department/{name}', [FrontendController::class , 'get_department'])->name('department');
// cases
Route::get('/cases', [FrontendController::class , 'cases'])->name('cases');
Route::get('/cases/case-details/{id}', [FrontendController::class , 'caseDetails'])->name('case-details');

// blogs
Route::get('/blogs', [FrontendController::class , 'blogs'])->name('blogs');
Route::get('/blogs/blog-details/{id}', [FrontendController::class , 'blogDetails'])->name('blog-details');




