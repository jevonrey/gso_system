<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\IssuanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicDashboardController;
use App\Http\Controllers\PublicDepartmentController;
use Illuminate\Support\Facades\Route;


//Redirects to Login
// Route::get('/', function () {
//     return view('public.dashboard');
// });

//View Public Records
Route::get('/', [PublicDashboardController::class, 'index'])->name('public.dashboard');
Route::get('/public/departments', [PublicDepartmentController::class, 'index'])->name('public.departments');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

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

//Furnitures and Fixtures
Route::get('/items/furniture', [ItemController::class, 'furniture'])->name('items.furniture');

//Vehicle
Route::get('/items/vehicle', [ItemController::class, 'vehicle'])->name('items.vehicle');

//Department View
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');


//Dashboard view change
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

 Route::resource('items', ItemController::class)->middleware('auth');

 Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');

 Route::get('/issuances', [IssuanceController::class, 'index'])->name('issuances.index');

 Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
 Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
require __DIR__.'/auth.php';
