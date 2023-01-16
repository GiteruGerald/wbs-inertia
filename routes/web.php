<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WaterReadingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::resource('apartments', ApartmentController::class);
Route::resource('units', UnitController::class);
Route::resource('readings', WaterReadingController::class);
Route::resource('bills', BillsController::class);
Route::get('apartments/{apartment}/units', [ApartmentController::class,'getUnitsByApartment'])->name('apartment.units');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
