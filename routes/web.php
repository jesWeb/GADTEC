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
use App\Http\Controllers\ProfileController;

// Rutas de autenticación
Route::get('/', function () {
    return view('auth.login');
});

// Rutas de autenticación (Login, Logout y Restablecimiento de Contraseña)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetLinkController::class, 'edit'])->name('password.reset');
Route::post('/reset-password', [PasswordResetLinkController::class, 'update'])->name('password.update');

// Rutas protegidas por el middleware 'auth'
Route::middleware('auth')->group(function () {

    // Rutas para el Administrador
    Route::middleware('role:Administrador')->group(function () {
        // Dashboard del Administrador
        Route::get('/dashboard', [GestionController::class, 'index'])->name("admin.dashboard");
        
        // Gestión de asignaciones y otros recursos
        Route::get('/autorizar/update/{id_asignacion}', [GestionController::class, 'update'])->name('autorizar');
        Route::resource('usuarios', UsuariosController::class);
        Route::resource('Automovil', AutomovilController::class);
        Route::resource('asignacion', AsignacionController::class);
        Route::resource('seguros', SegurosController::class);
        Route::resource('siniestros', SiniestrosController::class);
        Route::resource('verificaciones', VerificacionesController::class);
        Route::resource('tarjetas', TarjetaCirculacionController::class);
        Route::resource('tenencias', TeneciasRefrendosController::class);
        Route::resource('multas', MultasController::class);
        Route::resource('servicios', ServiciosController::class);
        
        // Rutas para la gestión de vigilantes
        Route::resource('/administrador/vigilante', VigilanteController::class);
        Route::get('/administrador/vigilante/edit2/{id}/', [VigilanteController::class, 'edit2'])->name('admin.edit2');
        Route::put('/admin/vigilante/update2/{id_asignacion}', [VigilanteController::class, 'update2'])->name('admin.update2');
        Route::get('/admin/vigilante/{id}', [VigilanteController::class, 'show'])->name('vigilante.admin');

        // Rutas para la gestión de autorizantes
        Route::resource('/administrador/autorizante', AutorizanteController::class);
        Route::get('/administrador/gestion/{id_automovil}', [GestionController::class, 'show'])->name('show.admin');

        // Rutas de Estadísticas y Reportes
        Route::get('/catalogos', [CatalogosController::class, 'index'])->name('catalogos.index');
        Route::get('/estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas');
        Route::get('js_tipo_servicio', [JsController::class, 'js_tipo_servicio'])->name('js_tipo_servicio');

        // Reportes PDF
        Route::get('/automoviles-pdf', [AutomovilController::class, 'generateReport'])->name('automoviles-pdf');
        Route::get('/multas-pdf', [MultasController::class, 'generateReport'])->name('multas-pdf');
        Route::get('/servicios-pdf', [ServiciosController::class, 'generateReport'])->name('servicios-pdf');
        Route::get('/usuarios-pdf', [UsuariosController::class, 'generateReport'])->name('usuarios-pdf');

        // Rutas para los reportes de estadística de vehículos
        Route::get('/estadisticas/vehiculo/{id}/reporte', [EstadisticasController::class, 'generarReporte'])->name('estadisticas.generarReporte');
        Route::get('/estadisticas/vehiculo/{id}/reporte/descargar', [EstadisticasController::class, 'descargarReporte'])->name('estadisticas.descargarReporte');
    });

    // Rutas para el Moderador (Vigilante)
    Route::middleware('role:Moderador')->group(function () {
        // Dashboard del Moderador
        Route::get('/moderador/dashboard', [GestionController::class, 'index'])->name('moderator.dashboard');

        // Gestión de vigilantes por parte del moderador
        Route::get('/moderador/vigilante', [VigilanteController::class, 'index'])->name('moderador.vigilante');
        Route::put('/vigilante/asignacion/{id_asignacion}', [VigilanteController::class, 'update'])->name('update.vigilante');
        Route::get('/vigilante/edit/{id}/', [VigilanteController::class, 'edit'])->name('moderador.edit');
        Route::get('/vigilante/edit2/{id}/', [VigilanteController::class, 'edit2'])->name('moderador.edit2');
        Route::put('/vigilante/update2/{id_asignacion}', [VigilanteController::class, 'update2'])->name('moderador.update2');
        Route::get('/vigilante/{id}', [VigilanteController::class, 'show'])->name('vigilante.show');
    });

    // Rutas para el Usuario
    Route::middleware('role:Usuario')->group(function () {
        // Dashboard del Usuario
        Route::get('/user/dashboard', [AutorizanteController::class, 'index'])->name('user.dashboard');
    });

    // Rutas comunes para Administrador y Moderador
    Route::middleware('role:Administrador|Moderador')->group(function () {
        Route::get('/gestion', [GestionController::class, 'index'])->name('Gestion');
        
    });

    // Rutas comunes para Administrador y Usuario
    Route::middleware('role:Administrador|Usuario')->group(function () {
        Route::resource('autorizante', AutorizanteController::class);
    });
});