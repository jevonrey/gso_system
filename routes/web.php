<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\IssuanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicDashboardController;
use App\Http\Controllers\PublicDepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\FuelControlController;
use App\Http\Controllers\FuelAllocationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

// Other page placeholders
Route::view('/about', 'website.about')->name('about');
Route::view('/staff', 'website.staff')->name('staff');
Route::view('/booking', 'booking.index')->name('booking');
Route::view('/contact', 'website.contact')->name('contact');

//Admin Role Route
Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});

//View Public Records
Route::get('/public/dashboard', [PublicDashboardController::class, 'index'])->name('public.dashboard');
Route::get('/public/departments', [PublicDepartmentController::class, 'index'])->name('public.departments');

//Fuel Controls Route
Route::prefix('fuel_controls')->middleware(['auth'])->group(function () {
    // View (accessible to all authenticated users)
    Route::get('/', [FuelControlController::class, 'index'])->name('fuel_controls.index');

    //Export Fuel Records
    Route::get('/fuel_controls.export', [FuelControlController::class, 'export'])->name('fuel_controls.export');


    // Admin-only actions
    Route::middleware(['admin'])->group(function () {
        Route::get('/create', [FuelControlController::class, 'create'])->name('fuel_controls.create');
        Route::post('/', [FuelControlController::class, 'store'])->name('fuel_controls.store');
        Route::get('/{id}/edit', [FuelControlController::class, 'edit'])->name('fuel_controls.edit');
        Route::put('/{id}', [FuelControlController::class, 'update'])->name('fuel_controls.update');
        Route::delete('/{id}', [FuelControlController::class, 'destroy'])->name('fuel_controls.destroy');
    });
});

//Fuel Allocations Route
Route::prefix('fuel_controls/allocations')->middleware(['auth'])->group(function () {
    Route::get('/', [FuelAllocationController::class, 'index'])->name('fuel_controls.allocations.index');
    Route::get('/create', [FuelAllocationController::class, 'create'])->name('fuel_controls.allocations.create'); // ADD
    Route::post('/', [FuelAllocationController::class, 'store'])->name('fuel_controls.allocations.store');
    Route::get('/{id}/edit', [FuelAllocationController::class, 'edit'])->name('fuel_controls.allocations.edit'); // ADD
    Route::put('/{id}', [FuelAllocationController::class, 'update'])->name('fuel_controls.allocations.update');
    Route::delete('/{id}', [FuelAllocationController::class, 'destroy'])->name('fuel_controls.allocations.destroy');
});

//Facility Bookings
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/request', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

//Booking Admin Panel
Route::prefix('admin/booking')->middleware(['auth'])->group(function () {
    Route::get('/', [BookingAdminController::class, 'index'])->name('admin.booking.index');
    Route::get('/{id}/edit', [BookingAdminController::class, 'edit'])->name('admin.booking.edit');
    Route::put('/{id}', [BookingAdminController::class, 'update'])->name('admin.booking.update');
    Route::delete('/{id}', [BookingAdminController::class, 'destroy'])->name('admin.booking.destroy');
});

//Edit items
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');

//Items Submenu Route
Route::prefix('items')->group(function () {
    Route::get('/missing', [ItemController::class, 'missing'])->name('items.missing');
    Route::get('/unserviceable', [ItemController::class, 'unserviceable'])->name('items.unserviceable');
    Route::get('/disposal', [ItemController::class, 'disposal'])->name('items.disposal');
    Route::get('/items/it', [ItemController::class, 'it'])->name('items.it');
    Route::get('/items/office', [ItemController::class, 'office'])->name('items.office');
    Route::get('/items/furniture', [ItemController::class, 'furniture'])->name('items.furniture');
    Route::get('/items/vehicle', [ItemController::class, 'vehicle'])->name('items.vehicle');
});

//Department Submenu Route
Route::prefix('departments')->group(function () {
    Route::get('/index', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/export', [DepartmentController::class, 'export'])->name('departments.export');
});

//Issuances Submenu Route
Route::prefix('issuances')->group(function () {
    Route::get('/index', [DepartmentController::class, 'index'])->name('issuances.index');
});

//Department View
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/index', [DepartmentController::class, 'index'])->name('departments.index');


//Export Department Route
Route::get('/departments/export', [DepartmentController::class, 'export'])->name('departments.export');

//Dashboard view change
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::resource('items', ItemController::class)->middleware('auth');

Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');

Route::get('/issuances', [IssuanceController::class, 'index'])->name('issuances.index');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

require __DIR__ . '/auth.php';
