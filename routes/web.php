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
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\JsController;
use App\Http\Controllers\VigilanteController;


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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Usa 'prefix' como parte de la configuración de grupo de rutas, no como middleware.
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return app(GestionController::class)->index();
    })->name('dashboard');
});




Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name("dashboard");

    Route::get('/gestion', function () {
        return app(GestionController::class)->index();
    })->name("Gestion");
    Route::get('/gestion/{id_asignacion}', [GestionController::class, 'show'])->name('gestion');
    Route::resource('Automovil', AutomovilController::class);
    Route::get('/automoviles-pdf', [AutomovilController::class,'generateReport'])->name('automoviles-pdf');
    Route::resource('asignacion', AsignacionController::class);
    Route::resource('seguros', SegurosController::class);
    Route::resource('siniestros', SiniestrosController::class);
    Route::resource('verificaciones', VerificacionesController::class);
    Route::get('/catalogos', [CatalogosController::class, 'index'])->name('catalogos.index');
    
    
  
});

    Route::resource('vigilante', VigilanteController::class);

    Route::get('/estadisticas', [EstadisticasController::class, 'index']);
    Route::resource('tarjetas', TarjetaCirculacionController::class);
    Route::resource('tenencias', TeneciasRefrendosController::class);
    Route::resource('usuarios', UsuariosController::class);
    Route::resource('multas', MultasController::class);
    Route::resource('servicios', ServiciosController::class);
    Route::get('js_tipo_servicio', [JsController::class, 'js_tipo_servicio'])->name('js_tipo_servicio');
    Route::get('/multas-pdf', [MultasController::class,'generateReport'])->name('multas-pdf');
    Route::get('/multas/generateReport', [MultasController::class, 'generateReport'])->name('multas.generateReport');
    Route::get('/servicios-pdf', [ServiciosController::class,'generateReport'])->name('servicios-pdf');
    Route::get('/usuarios-pdf', [UsuariosController::class,'generateReport'])->name('usuarios-pdf');
   


require __DIR__ . '/auth.php';
