<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\CustomerAuthController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/how-it-works', [HomeController::class, 'howItWorks'])->name('how-it-works');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');


// Customer Auth
Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.login.post')->middleware('throttle:5,1');
Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register.post')->middleware('throttle:5,1');
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// Customer & Driver Profile / Orders
Route::middleware('auth')->group(function () {
    Route::get('/profile', [CustomerProfileController::class, 'index'])->name('profile');
    Route::get('/profile/settings', [CustomerProfileController::class, 'settings'])->name('profile.settings');
    Route::put('/profile/settings', [CustomerProfileController::class, 'updateSettings'])->name('profile.settings.update');

    // Driver Portfolio
    Route::get('/driver/portfolio', [\App\Http\Controllers\DriverPortfolioController::class, 'index'])->name('driver.portfolio');
    Route::put('/driver/portfolio/orders/{order}/status', [\App\Http\Controllers\DriverPortfolioController::class, 'updateStatus'])->name('driver.portfolio.update-status');
});

Route::get('/category/{category}/order', [OrderController::class, 'create'])->name('order.create');
Route::post('/category/{category}/order', [OrderController::class, 'store'])->name('order.store');




Route::prefix('dashboard')->name('admin.')->group(function () {
    // Auth Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/settings', [DashboardController::class, 'editSettings'])->name('settings.edit');
        Route::put('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('stores', StoreController::class)->except(['show']);
        Route::resource('delivery-areas', DeliveryAreaController::class)->except(['show']);
        Route::resource('drivers', DriverController::class);
        Route::post('users/{user}/convert-to-driver', [UserController::class, 'convertToDriver'])->name('users.convert-to-driver');
        Route::resource('users', UserController::class);
        
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
    });
});