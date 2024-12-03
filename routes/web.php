<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AutomovilController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\SegurosController;
use App\Http\Controllers\SiniestrosController;
use App\Http\Controllers\VerificacionesController;
use App\Http\Controllers\VigilanteController;
use App\Http\Controllers\TarjetaCirculacionController;
use App\Http\Controllers\TeneciasRefrendosController;
use App\Http\Controllers\MultasController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\JsController;
use App\Http\Controllers\AutorizanteController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar rutas web para tu aplicación.
| Todas las rutas se cargan por medio del RouteServiceProvider.
|
*/



Route::get('/', function () {
    return view('auth.login');
});

// Rutas de autenticación

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de restablecimiento de contraseña
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetLinkController::class, 'edit'])->name('password.reset');
Route::post('/reset-password', [PasswordResetLinkController::class, 'update'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::middleware('role:Administrador|Moderador')->group(function () {
        Route::get('/gestion', [GestionController::class, 'index'])->name('Gestion');
        Route::get('/gestion/{id_asignacion}', [GestionController::class, 'show'])->name('show.gestion');
        Route::resource('vigilante', VigilanteController::class);
        Route::get('/vigilante/edit2/{id}/', [VigilanteController::class, 'edit2'])->name('edit2');
        Route::put('/vigilante/update2/{id_asignacion}', [VigilanteController::class, 'update2'])->name('update2');
    });
});


// Rutas protegidas por el middleware 'auth'
Route::middleware('auth')->group(function () {

    // Route::middleware('role:Administrador|Moderador')->group(function () {
    //     Route::get('/gestion', [GestionController::class, 'index'])->name('Gestion');
    //     Route::get('/gestion/{id_asignacion}', [GestionController::class, 'show'])->name('gestion');
    //     Route::resource('vigilante', VigilanteController::class);
    //     Route::get('/vigilante/edit2/{id}/', [VigilanteController::class, 'edit2'])->name('edit2');
    //         Route::put('/vigilante/update2/{id_asignacion}', [VigilanteController::class, 'update2'])->name('update2');

    // });



    Route::middleware('role:Administrador|Usuario')->group(function () {
        Route::resource('autorizante', AutorizanteController::class);
    });

    // Rutas para el Administrador
    Route::middleware('role:Administrador')->group(function () {
        Route::get('/dashboard', function () {
            return app(GestionController::class)->index();
         })->name("admin.dashboard");
        Route::get('/autorizar/update/{id_asignacion}', [GestionController::class, 'update'])->name('autorizar');
        Route::resource('usuarios', UsuariosController::class);

        Route::resource('Automovil', AutomovilController::class);
        //file pond
        Route::post('/temp-upload', [AutomovilController::class, 'tempUpload']);
        Route::delete('/temp-remove/{file}', [AutomovilController::class, 'tempDelete']);
        //  Route::get('/load-fotografias', [FileUploadController::class, 'index'])->name('load-fotografias');


        Route::resource('asignacion', AsignacionController::class);
        Route::resource('seguros', SegurosController::class);
        Route::resource('siniestros', SiniestrosController::class);
        Route::resource('verificaciones', VerificacionesController::class);
        Route::resource('tarjetas', TarjetaCirculacionController::class);
        Route::resource('tenencias', TeneciasRefrendosController::class);
        Route::resource('multas', MultasController::class);
        Route::resource('servicios', ServiciosController::class);
        Route::resource('/administrador/vigilante', VigilanteController::class);
        Route::get('/administrador/vigilante/edit2/{id}/', [VigilanteController::class, 'edit2'])->name('edit2');
        Route::put('/admin/vigilante/update2/{id_asignacion}', [VigilanteController::class, 'update2'])->name('update2');
        Route::resource('/administrador/autorizante', AutorizanteController::class);
        Route::get('administrador/gestion/{id_asignacion}', [GestionController::class, 'show'])->name('show.gestion');

        Route::get('/catalogos', [CatalogosController::class, 'index'])->name('catalogos.index');
        Route::get('/estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas');
        Route::get('js_tipo_servicio', [JsController::class, 'js_tipo_servicio'])->name('js_tipo_servicio');

        Route::get('/automoviles-pdf', [AutomovilController::class, 'generateReport'])->name('automoviles-pdf');
        Route::get('/multas-pdf', [MultasController::class, 'generateReport'])->name('multas-pdf');
        Route::get('/servicios-pdf', [ServiciosController::class, 'generateReport'])->name('servicios-pdf');
        Route::get('/usuarios-pdf', [UsuariosController::class, 'generateReport'])->name('usuarios-pdf');

        Route::get('/estadisticas/vehiculo/{id}/reporte', [EstadisticasController::class, 'generarReporte'])->name('estadisticas.generarReporte');
        Route::get('/estadisticas/vehiculo/{id}/reporte/descargar', [EstadisticasController::class, 'descargarReporte'])->name('estadisticas.descargarReporte');
    });

    // Rutas para el Moderador (Vigilante)
    Route::middleware('role:Moderador')->group(function () {
        Route::get('/moderador/dashboard', [GestionController::class, 'index'])->name('moderator.dashboard');
        Route::get('/moderador/vigilante', [VigilanteController::class, 'index'])->name('moderador.vigilante');
        Route::get('/vigilante/edit2/{id}/', [VigilanteController::class, 'edit2'])->name('edit2');
        Route::put('/vigilante/update2/{id_asignacion}', [VigilanteController::class, 'update2'])->name('update2');
        

    });

    // Rutas para el Usuario
    Route::middleware('role:Usuario')->group(function () {
        Route::get('/user/dashboard', [AutorizanteController::class, 'index'])->name('user.dashboard');
    });
});
