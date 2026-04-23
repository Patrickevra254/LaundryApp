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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BranchController;

// ── Public routes ─────────────────────────────────────────────────────────────

Route::get('/', fn() => view('layouts.login3'))->name('login');

Route::post('/login',    [AuthController::class, 'login'])->name('login.store');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

// Forgot / Reset password
Route::get('/forgot-password',        [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password',       [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password',        [ResetPasswordController::class, 'reset'])->name('password.update');

// Social OAuth
Route::get('auth/{provider}',          [SocialAuthController::class, 'redirect'])->name('oauth.redirect');
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('oauth.callback');


// ── Authenticated — ALL roles ─────────────────────────────────────────────────

Route::middleware('auth')->group(function () {

    // Dashboard (role-based redirect handled inside controller)
    Route::get('/admin-dashboard',    [AdminController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/customer-dashboard', [AdminController::class, 'customerDashboard'])->name('customerDashboard');

    // Profile
    Route::get('/profile',  [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Preferences & notifications (all roles)
    Route::get('/preferences',  [AdminController::class, 'preferences'])->name('preferences');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');

    Route::post('/notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');

    Route::post('/notifications/{notification}/read',   [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/{notification}',      [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications',                     [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');

    // Laundry items — view only (customers see active only, handled in controller)
    Route::get('/items', [AdminController::class, 'items'])->name('items');

    // Paystack callback (needs to be accessible after redirect)
    Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('payment.callback');
});


// ── Authenticated — Customers + Staff + Admin + SuperAdmin ────────────────────

Route::middleware(['auth', 'role:customer|staff|admin|superAdmin'])->group(function () {

    // Book laundry
    Route::get('/bookLaundry', [AdminController::class, 'bookLaundry'])->name('bookLaundry');

    // Order creation paths
    Route::post('/pay',         [PaymentController::class, 'redirectToGateway'])->name('payment.redirect');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

    // Customer complete payment
    Route::get('/order/{order}/complete-payment', [OrderController::class, 'completePayment'])->name('order.completePayment');

    // Orders & tracking (customers see their own, staff/admin see branch — filtered in controller)
    Route::get('/orderTrack', [AdminController::class, 'orderTrack'])->name('orderTrack');
    Route::get('/history',    [AdminController::class, 'history'])->name('history');
    Route::get('/payments',   [AdminController::class, 'payments'])->name('payments');

    // Customer search (for booking form)
    Route::get('/customers/search', [CustomerController::class, 'searchCustomers'])->name('customers.search');
});


// ── Authenticated — Staff + Admin + SuperAdmin only ───────────────────────────

Route::middleware(['auth', 'role:staff|admin|superAdmin'])->group(function () {

    // Update order status & details
    Route::match(['patch', 'put'], '/orders/{order}/status',  [LaundryOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::patch('/orders/{order}/details', [OrderController::class, 'updateDetails'])->name('orders.updateDetails');

    // Record payment against existing order
    Route::post('/order/{order}/payment', [OrderController::class, 'recordPayment'])->name('order.recordPayment');

    // View customer and staff lists (filtered by branch in controller)
    Route::get('/customer', [UserController::class, 'customerIndex'])->name('customer');
    Route::get('/customer/{user}',    [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/staff',    [UserController::class, 'staffIndex'])->name('staff');
    Route::get('/staff/{user}',    [StaffController::class, 'show'])->name('staff.show');
});


// ── Authenticated — Admin + SuperAdmin only ───────────────────────────────────

Route::middleware(['auth', 'role:admin|superAdmin'])->group(function () {

    // Users — view lists
    Route::get('/admin',       [UserController::class, 'admin'])->name('admin');


    // Admin CRUD
    Route::get('/admin/{user}',    [AdminsController::class, 'show'])->name('admin.show');
    Route::post('/admin',          [AdminsController::class, 'admin'])->name('admin.store');
    Route::put('/admin/{user}',    [AdminsController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{user}', [AdminsController::class, 'destroy'])->name('admin.destroy');

    // Staff CRUD
    // Route::get('/staff/{user}',    [StaffController::class, 'show'])->name('staff.show');
    Route::post('/staff',          [StaffController::class, 'storeStaff'])->name('staff.store');
    Route::put('/staff/{user}',    [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{user}', [StaffController::class, 'destroy'])->name('staff.destroy');

    // Customer CRUD
    // Route::get('/customer/{user}',    [CustomerController::class, 'show'])->name('customer.show');
    Route::post('/customer',          [CustomerController::class, 'storeCustomer'])->name('customer.store');
    Route::put('/customer/{user}',    [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{user}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    // Laundry categories
    Route::post('/laundry-categories',            [LaundryCategoryController::class, 'store'])->name('laundry-categories.store');
    Route::delete('/laundry-categories/{category}', [LaundryCategoryController::class, 'destroy'])->name('laundry-categories.destroy');

    // Laundry items CRUD
    Route::post('/laundry-items',           [LaundryItemController::class, 'store'])->name('laundry-items.store');
    Route::get('/laundry-items/{laundryItem}',    [LaundryItemController::class, 'show'])->name('laundry-items.show');
    Route::put('/laundry-items/{laundryItem}',    [LaundryItemController::class, 'update'])->name('laundry-items.update');
    Route::delete('/laundry-items/{laundryItem}', [LaundryItemController::class, 'destroy'])->name('laundry-items.destroy');

    // Delete orders & payments
    Route::delete('/orders/{order}',   [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
});


// ── Authenticated — SuperAdmin only ──────────────────────────────────────────

Route::middleware(['auth', 'role:superAdmin'])->group(function () {

    // superAdmin user view
    Route::get('/super-admin', [UserController::class, 'superAdmin'])->name('superAdmin');

    // Branches
    Route::get('/branches',              [AdminController::class, 'branches'])->name('branches');
    Route::post('/branches',             [BranchController::class, 'store'])->name('branches.store');
    Route::put('/branches/{branch}',     [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/branches/{branch}',  [BranchController::class, 'destroy'])->name('branches.destroy');

    // SuperAdmin CRUD
    Route::post('/super-Admin',          [SuperAdminController::class, 'superAdmin'])->name('superAdmin.store');
    Route::get('/super-admin/{user}',    [SuperAdminController::class, 'show'])->name('superAdmin.show');
    Route::put('/super-admin/{user}',    [SuperAdminController::class, 'update'])->name('superAdmin.update');
    Route::delete('/super-admin/{user}', [SuperAdminController::class, 'destroy'])->name('superAdmin.destroy');
});

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\CustomerController;
// use App\Http\Controllers\StaffController;
// use App\Http\Controllers\SuperAdminController;
// use App\Http\Controllers\AdminsController;
// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\SocialAuthController;
// use App\Http\Controllers\LaundryCategoryController;
// use App\Http\Controllers\LaundryItemController;
// use App\Http\Controllers\LaundryOrderController;
// use App\Http\Controllers\PaymentController;
// use App\Http\Controllers\NotificationController;
// use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\Auth\ResetPasswordController;
// use App\Http\Controllers\OrderController;
// use App\Http\Controllers\BranchController;



// Route::get('/', function () {
//     return view('layouts.login3');
// })->name('login');


// Authentication handlers
// Route::post('/login', [AuthController::class, 'login'])->name('login.store');
// Route::post('/register', [AuthController::class, 'register'])->name('register.store');
// Route::post('/customer', [CustomerController::class, 'storeCustomer'])->name('customer.store');
// Route::post('/staff', [StaffController::class, 'storeStaff'])->name('staff.store');
// Route::post('/admin', [AdminsController::class, 'admin'])->name('admin.store');
// Route::post('/super-Admin', [SuperAdminController::class, 'superAdmin'])->name('superAdmin.store');

// Forgot Password
// Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password
// Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Protected Admin pages
// Route::middleware('auth')->group(function () {

//     Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
//     Route::get('/customer-dashboard', [AdminController::class, 'customerDashboard'])->name('customerDashboard');

//     Route::get('/admin', [UserController::class, 'admin'])->name('admin');
//     Route::get('/super-admin', [UserController::class, 'superAdmin'])->name('superAdmin');
//     Route::get('/customer', [UserController::class, 'customerIndex'])->name('customer');
//     Route::get('/staff', [UserController::class, 'staffIndex'])->name('staff');
//     Route::get('/history', [AdminController::class, 'history'])->name('history');
//     Route::get('/orderTrack', [AdminController::class, 'orderTrack'])->name('orderTrack');
//     Route::get('/bookLaundry', [AdminController::class, 'bookLaundry'])->name('bookLaundry');

//     Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
//     Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
//     Route::get('/preferences', [AdminController::class, 'preferences'])->name('preferences');

//     Route::get('/items', [AdminController::class, 'items'])->name('items');
//     // Route::get('/laundryCategory', [AdminController::class, 'laundryCategory'])->name('laundryCategory');

//     Route::get('/payments', [AdminController::class, 'payments'])->name('payments');



//     Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
//     Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');


//     // Route for Logout accessible for authenticated users
//     Route::post('logout', [AuthController::class,  'logout'])->name('logout');


//     // SuperAdmin management
//     Route::get('/super-admin/{user}', [SuperAdminController::class, 'show'])
//         ->name('superAdmin.show');

//     Route::put('/super-admin/{user}', [SuperAdminController::class, 'update'])
//         ->name('superAdmin.update');

//     Route::delete('/super-admin/{user}', [SuperAdminController::class, 'destroy'])
//         ->name('superAdmin.destroy');

//     // Admin management
//     Route::get('/admin/{user}', [AdminsController::class, 'show'])
//         ->name('admin.show');

//     Route::put('/admin/{user}', [AdminsController::class, 'update'])
//         ->name('admin.update');

//     Route::delete('/admin/{user}', [AdminsController::class, 'destroy'])
//         ->name('admin.destroy');

//     // Staff management
//     Route::get('/staff/{user}', [StaffController::class, 'show'])
//         ->name('staff.show');

//     Route::put('/staff/{user}', [StaffController::class, 'update'])
//         ->name('staff.update');

//     Route::delete('/staff/{user}', [StaffController::class, 'destroy'])
//         ->name('staff.destroy');


//     // Customer management
//     Route::get('/customer/{user}', [CustomerController::class, 'show'])
//         ->name('customer.show');

//     Route::put('/customer/{user}', [CustomerController::class, 'update'])
//         ->name('customer.update');

//     Route::delete('/customer/{user}', [CustomerController::class, 'destroy'])
//         ->name('customer.destroy');



//     Route::post('/laundry-categories', [LaundryCategoryController::class, 'store'])
//         ->name('laundry-categories.store');

//     Route::delete('/laundry-categories/{category}', [LaundryCategoryController::class, 'destroy'])
//         ->name('laundry-categories.destroy');

//     // Laundry Items (CRUD + AJAX)
//     Route::prefix('laundry-items')->group(function () {

//         // Create
//         Route::post('/', [LaundryItemController::class, 'store'])
//             ->name('laundry-items.store');

//         // Fetch single item (AJAX)
//         Route::get('/{laundryItem}', [LaundryItemController::class, 'show'])
//             ->name('laundry-items.show');

//         // Update
//         Route::put('/{laundryItem}', [LaundryItemController::class, 'update'])
//             ->name('laundry-items.update');

//         // Delete
//         Route::delete('/{laundryItem}', [LaundryItemController::class, 'destroy'])
//             ->name('laundry-items.destroy');

//         Route::get('/customers/search', [CustomerController::class, 'searchCustomers'])
//             ->name('customers.search');

//         Route::post('/laundry-orders', [LaundryOrderController::class, 'store'])
//             ->name('laundry-orders.store');
//     });

//     // update order status
//     Route::match(
//         ['patch', 'put'],
//         '/orders/{order}/status',
//         [LaundryOrderController::class, 'updateStatus']
//     )->name('orders.updateStatus');

//     // paystack payments
//     Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('payment.redirect');
//     Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('payment.callback');




//     // Direct order creation (cash/transfer)
//     Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

//     // Record payment against existing order
//     Route::post('/order/{order}/payment', [OrderController::class, 'recordPayment'])->name('order.recordPayment');

//     // notifications Mark all as read
//     Route::post('/notifications/read-all', function () {
//         auth()->user()->unreadNotifications->markAsRead();
//         return back();
//     })->name('notifications.readAll');

//     Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
//         ->name('notifications.read');

//     Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])
//         ->name('notifications.destroy');

//     Route::delete('/notifications', [NotificationController::class, 'destroyAll'])
//         ->name('notifications.destroyAll');

//     Route::get('/order/{order}/complete-payment', [OrderController::class, 'completePayment'])->name('order.completePayment');
//     Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
//     Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

//     // update order details
//     Route::patch('/orders/{order}/details', [OrderController::class, 'updateDetails'])->name('orders.updateDetails');



//     // To this:
//     Route::get('/branches', [AdminController::class, 'branches'])->name('branches');

//     // Keep these as they are:
//     Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
//     Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
//     Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');
// });


// // Social OAuth
// Route::get('auth/{provider}', [SocialAuthController::class, 'redirect'])->name('oauth.redirect');
// Route::get('auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('oauth.callback');
