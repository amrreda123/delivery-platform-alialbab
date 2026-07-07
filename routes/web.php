<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DriverController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/how-it-works', [HomeController::class, 'howItWorks'])->name('how-it-works');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');

Route::get('/category/{category}/order', [OrderController::class, 'create'])->name('order.create');
Route::post('/category/{category}/order', [OrderController::class, 'store'])->name('order.store');



Route::prefix('dashboard')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/settings', [DashboardController::class, 'editSettings'])->name('settings.edit');
    Route::put('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('stores', StoreController::class)->except(['show']);
    Route::resource('delivery-areas', DeliveryAreaController::class)->except(['show']);
    Route::resource('drivers', DriverController::class)->except(['show']);
    
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
});