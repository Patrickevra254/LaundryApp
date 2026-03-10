<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\LaundryCategoryController;
use App\Http\Controllers\LaundryItemController;
use App\Http\Controllers\LaundryOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;



// Login page
// Route::get('/', function () {
//     return view('layouts.login3');
// })->name('login');

Route::get('/', function () {
    return view('layouts.login3');
})->name('login');


// Authentication handlers
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/customer', [CustomerController::class, 'storeCustomer'])->name('customer.store');
Route::post('/staff', [StaffController::class, 'storeStaff'])->name('staff.store');
Route::post('/admin', [AdminsController::class, 'admin'])->name('admin.store');
Route::post('/super-Admin', [SuperAdminController::class, 'superAdmin'])->name('superAdmin.store');

// Protected Admin pages
Route::middleware('auth')->group(function () {

    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');

    Route::get('/admin', [UserController::class, 'admin'])->name('admin');
    Route::get('/super-admin', [UserController::class, 'superAdmin'])->name('superAdmin');
    Route::get('/customer', [UserController::class, 'customerIndex'])->name('customer');
    Route::get('/staff', [UserController::class, 'staffIndex'])->name('staff');
    Route::get('/history', [AdminController::class, 'history'])->name('history');
    Route::get('/orderTrack', [AdminController::class, 'orderTrack'])->name('orderTrack');
    Route::get('/bookLaundry', [AdminController::class, 'bookLaundry'])->name('bookLaundry');

    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('/preferences', [AdminController::class, 'preferences'])->name('preferences');

    Route::get('/items', [AdminController::class, 'items'])->name('items');
    Route::get('/category', [AdminController::class, 'category'])->name('category');

    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');



    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');


    // Route for Logout accessible for authenticated users
    Route::post('logout', [AuthController::class,  'logout'])->name('logout');


    // SuperAdmin management
    Route::get('/super-admin/{user}', [SuperAdminController::class, 'show'])
        ->name('superAdmin.show');

    Route::put('/super-admin/{user}', [SuperAdminController::class, 'update'])
        ->name('superAdmin.update');

    Route::delete('/super-admin/{user}', [SuperAdminController::class, 'destroy'])
        ->name('superAdmin.destroy');

    // Admin management
    Route::get('/admin/{user}', [AdminsController::class, 'show'])
        ->name('admin.show');

    Route::put('/admin/{user}', [AdminsController::class, 'update'])
        ->name('admin.update');

    Route::delete('/admin/{user}', [AdminsController::class, 'destroy'])
        ->name('admin.destroy');

    // Staff management
    Route::get('/staff/{user}', [StaffController::class, 'show'])
        ->name('staff.show');

    Route::put('/staff/{user}', [StaffController::class, 'update'])
        ->name('staff.update');

    Route::delete('/staff/{user}', [StaffController::class, 'destroy'])
        ->name('staff.destroy');


    // Customer management
    Route::get('/customer/{user}', [CustomerController::class, 'show'])
        ->name('customer.show');

    Route::put('/customer/{user}', [CustomerController::class, 'update'])
        ->name('customer.update');

    Route::delete('/customer/{user}', [CustomerController::class, 'destroy'])
        ->name('customer.destroy');



    // Route::post('/laundry-categories', [LaundryCategoryController::class, 'store'])
    //     ->name('laundry-categories.store');

    // Route::delete('/laundry-categories/{category}', [LaundryCategoryController::class, 'destroy'])
    //     ->name('laundry-categories.destroy');


    // Route::prefix('laundry-categories')->group(function () {

    //     Route::post('/', [LaundryCategoryController::class, 'store'])
    //         ->name('laundry-categories.store');

    //     Route::delete('/{category}', [LaundryCategoryController::class, 'destroy'])
    //         ->name('laundry-categories.destroy');
    // });



    // Laundry Items (CRUD + AJAX)
    Route::prefix('laundry-items')->group(function () {

        // Create
        Route::post('/', [LaundryItemController::class, 'store'])
            ->name('laundry-items.store');

        // Fetch single item (AJAX)
        Route::get('/{laundryItem}', [LaundryItemController::class, 'show'])
            ->name('laundry-items.show');

        // Update
        Route::put('/{laundryItem}', [LaundryItemController::class, 'update'])
            ->name('laundry-items.update');

        // Delete
        Route::delete('/{laundryItem}', [LaundryItemController::class, 'destroy'])
            ->name('laundry-items.destroy');

        Route::get('/customers/search', [CustomerController::class, 'searchCustomers'])
            ->name('customers.search');

        Route::post('/laundry-orders', [LaundryOrderController::class, 'store'])
            ->name('laundry-orders.store');
        Route::get('/order/{order}/complete-payment', [OrderController::class, 'completePayment'])->name('order.completePayment');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    });
});


// Social OAuth
Route::get('auth/{provider}', [SocialAuthController::class, 'redirect'])->name('oauth.redirect');
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('oauth.callback');
