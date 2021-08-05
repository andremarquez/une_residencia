<?php

use App\Http\Controllers\ApartamentoController;
use App\Http\Controllers\CuentaApartamentoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\GastoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioTesoreroController;
use App\Models\CuentaApartamento;

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

// Ruta para manejar el login, se ejecuta la funcion authenticate del controlador
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
        // crear todas las rutas CRUD de Usuario Tesorero
        // index = Listar,
        // create = Mostrar formulario para registrar
        // store = action post del formulario para crear
        // edit =  ir al formulario para editar
        // udpate = action post/put para actualizar usuario
        Route::resource('tesorero', UsuarioTesoreroController::class);
        // activar y desactivar tesorero
        Route::post('/tesorero/{tesorero}/disable', [UsuarioTesoreroController::class, 'disable'])->name('tesorero.disable');
        Route::post('/tesorero/{tesorero}/active', [UsuarioTesoreroController::class, 'active'])->name('tesorero.active');

        // listar apartamentos
        Route::get('/apartamentos', [ApartamentoController::class, 'index'])->name('apartamentos.index');


        // Rutas para Propietarios 
        Route::get('propietario/',[ CuentaApartamentoController::class, 'index'])->name('propietario.index');
        Route::get('propietario/create',[ CuentaApartamentoController::class, 'create'])->name('propietario.create');
        Route::post('propietario/store',[ CuentaApartamentoController::class, 'store'])->name('propietario.store');
        Route::get('propietario/{propietario}/edit',[ CuentaApartamentoController::class, 'edit'])->name('propietario.edit');
        Route::match(['put', 'post'],'propietario/{propietario}',[ CuentaApartamentoController::class, 'update'])->name('propietario.update');

        Route::post('propietario/{propietario}/disable', [CuentaApartamentoController::class, 'disable'])->name('propietario.disable');
        Route::post('propietario/{propietario}/active', [CuentaApartamentoController::class, 'active'])->name('propietario.active');
        Route::post('propietario/{propietario}/liberar', [CuentaApartamentoController::class, 'liberar'])->name('propietario.liberar');

        // admin de proveedores
        Route::resource('proveedor', ProveedorController::class);
        Route::post('/proveedor/{proveedor}/disable', [ProveedorController::class, 'disable'])->name('proveedor.disable');
        Route::post('/proveedor/{proveedor}/active', [ProveedorController::class, 'active'])->name('proveedor.active');

    });


    // Rutas para Manejo de Gastos CRUD
    // mostrar listados
    Route::get('/gastos', [GastoController::class, 'index'])->name('gastos.index');
    // mostrar formulario para registrar
    Route::get('/gastos/create', [GastoController::class, 'create'])->name('gastos.create');
    // la accion del form de registrar
    Route::post('/gastos/store', [GastoController::class, 'store'])->name('gastos.store');
    // mostrar formulario para Editar
    Route::get('/gastos/{gasto}/edit', [GastoController::class, 'edit'])->name('gastos.edit');
    // la accion del form de registrar
    // route::mathc para trabajar con cualquier de los methods
    Route::match(['put','post'],'/gastos/{gasto}', [GastoController::class, 'update'])->name('gastos.update');

    Route::get('/gastos/{gasto}/show', [GastoController::class, 'show'])->name('gastos.show');

    Route::post('/gastos/{gasto}/aprobar', [GastoController::class, 'aprobar'])->name('gastos.aprobar');
    Route::post('/gastos/{gasto}/denegar', [GastoController::class, 'denegar'])->name('gastos.denegar');


    Route::get('/facturas', [FacturaController::class, 'index'])->name('facturas.index');


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

       // Route::get('/create',[ CuentaApartamentoController::class, 'create'])->name('create');

    });

    



});

/*
// rutas privadas, solo usuarios autenticados
Route::resource('roles', RoleController::class)->only([
    'index', 'show'
]);*/
