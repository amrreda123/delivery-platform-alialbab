<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/how-it-works', [HomeController::class, 'howItWorks'])->name('how-it-works');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');



Route::prefix('dashboard')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/settings', [DashboardController::class, 'editSettings'])->name('settings.edit');
    Route::put('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');
});