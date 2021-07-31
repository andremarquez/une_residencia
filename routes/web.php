<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioTesoreroController;

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


// Rutas publicas 
Route::get('/', function () {
    return view('index');
})->name('inicio');

// ruta para autenticar
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');

// debo validar si esta autenticado
// validar tipo de usuario
Route::group(['middleware' => 'auth:web'], function () {
    // cerrar session
    Route::get('/logout', [LoginController::class, 'logout']);

    // Rutas para Administracion
    Route::name('admin.')->prefix('admin')->group(function () {

        // dashboard
        Route::get('/', function () {
            return view('dashboard.admin');
        })->name('dashboard');

        // administracion de tesoreros
        Route::resource('tesorero', UsuarioTesoreroController::class);
    });


    // Rutas para Tesoreria 
    Route::name('tesorero.')->prefix('tesorero')->group(function () {
        Route::get('/', function () {
            return view('dashboard.tesorero');
        })->name('dashboard');
    });

    // Rutas para Propietarios 
    Route::name('propietario.')->prefix('propietario')->group(function () {
        Route::get('/', function () {
            return view('dashboard.propietario');
        })->name('dashboard');
    });

    //Route::resource('roles', RoleController::class);



});

/*
// rutas privadas, solo usuarios autenticados
Route::resource('roles', RoleController::class)->only([
    'index', 'show'
]);*/
