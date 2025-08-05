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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//Bookings
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/request', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

//Edit items
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');

//Missing Items
Route::get('/items/missing', [ItemController::class, 'missing'])->name('items.missing');

//Unserviceable items
Route::get('/items/unserviceable', [ItemController::class, 'unserviceable'])->name('items.unserviceable');

//Disposal Items
Route::get('/items/disposal', [ItemController::class, 'disposal'])->name('items.disposal');

//IT Equipment
Route::get('/items/it', [ItemController::class, 'it'])->name('items.it');

//Office
Route::get('/items/office', [ItemController::class, 'office'])->name('items.office');

//Furnitures and Fixtures
Route::get('/items/furniture', [ItemController::class, 'furniture'])->name('items.furniture');

//Vehicle
Route::get('/items/vehicle', [ItemController::class, 'vehicle'])->name('items.vehicle');

//Department View
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');

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
