<?php

use App\Http\Controllers\AutomovilController;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\SegurosController;
use App\Http\Controllers\SiniestrosController;
use App\Http\Controllers\VerificacionesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('Automovil',AutomovilController::class);
Route::resource('reservaciones',ReservacionController::class);
Route::resource('seguros',SegurosController::class);
Route::resource('siniestros',SiniestrosController::class);
Route::resource('verificaciones',VerificacionesController::class);
Route::resource('catalogos',CatalogosController::class);

require __DIR__ . '/auth.php';
