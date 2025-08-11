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
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

// Other page placeholders
Route::view('/about', 'website.about')->name('about');
Route::view('/staff', 'website.staff')->name('staff');
Route::view('/booking', 'booking.index')->name('booking');
Route::view('/contact', 'website.contact')->name('contact');

//View Public Records
Route::get('/public/dashboard', [PublicDashboardController::class, 'index'])->name('public.dashboard');
Route::get('/public/departments', [PublicDepartmentController::class, 'index'])->name('public.departments');

//Fuels Route
Route::resource('fuel_controls', FuelControlController::class);

//Bookings
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


//Export Route
Route::get('/departments/export', [DepartmentController::class, 'export'])->name('departments.export');

//Dashboard view change
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

 Route::resource('items', ItemController::class)->middleware('auth');

 Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');

 Route::get('/issuances', [IssuanceController::class, 'index'])->name('issuances.index');

 Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
 Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
require __DIR__.'/auth.php';
