<?php

use App\Http\Controllers\admin\Automovil;

use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\AutomovilController;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\SegurosController;
use App\Http\Controllers\SiniestrosController;
use App\Http\Controllers\VerificacionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\TarjetaCirculacionController;
use App\Http\Controllers\TeneciasRefrendosController;
use App\Http\Controllers\MultasController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\JsController;


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





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {

    Route::get('/gestion', function () {
        return app(GestionController::class)->index();
    })->name("Gestion");


    Route::get('/catalogos', [CatalogosController::class, 'index'])->name('catalogos.index');

    Route::resource('Automovil', AutomovilController::class);
    Route::resource('asignacion', AsignacionController::class);
    Route::resource('seguros', SegurosController::class);
    Route::resource('siniestros', SiniestrosController::class);
    Route::resource('verificaciones', VerificacionesController::class);

    Route::resource('usuarios', UsuariosController::class);
    Route::resource('tarjetas', TarjetaCirculacionController::class);
    Route::resource('tenencias', TeneciasRefrendosController::class);
    Route::resource('multas', MultasController::class);
    Route::resource('servicios', ServiciosController::class);
    Route::get('js_tipo_servicio', [JsController::class, 'js_tipo_servicio'])->name('js_tipo_servicio');
});



require __DIR__ . '/auth.php';
