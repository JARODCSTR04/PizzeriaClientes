<?php

use App\Http\Controllers\ApiPayPalController;
use App\Http\Controllers\ClientesLoginController;
use App\Http\Controllers\FakeStoreApiController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\IpDataController;
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

Route::middleware('clientes.auth')->group(function () {
    Route::get('/pagina/index', [IpDataController::class, 'getUserInfo'])->name('index');
    Route::get('/pagina/index', [InventarioController::class, 'index']);
    Route::view('/navegacion/navegacion', '/navegacion/navegacion');
    Route::view('/navegacion/navbarcliente', '/navegacion/navbarcliente');
    Route::view('/contacto', '/contacto');
    Route::get('/catalogo/listado', [FakeStoreApiController::class, 'productos']);
    Route::get('/catalogo/detalle/{id}', [FakeStoreApiController::class, 'productobyid']);
    Route::get('/prueba/producto', [InventarioController::class, 'productosCarrito']);
    Route::post('/carrito/agregar',[InventarioController::class, 'agregarCarrito']);
    Route::post('/carrito/quitar', [InventarioController::class, 'quitarCarrito']);
    Route::post('/carrito/incrementar', [InventarioController::class, 'incrementarCarrito']);
    Route::post('/carrito/decrementar', [InventarioController::class, 'decrementarCarrito']);
    //Api de Paypal
    Route::post('pay', [ApiPayPalController::class, 'pay'])->name('payment');
    Route::get('success', [ApiPayPalController::class, 'success']);
    Route::get('error', [ApiPayPalController::class, 'error']);
});

//Login Github
Route::get('auth/github', [GitHubController::class, 'redirect'])->name('github.login');
Route::get('auth/github/callback', [GitHubController::class, 'callback']);

//Login y Register
Route::get('/sesiones/register', [ClientesLoginController::class, 'index']);
Route::post('/sesiones/register', [ClientesLoginController::class, 'registrar']);
Route::get('/sesiones/login', [ClientesLoginController::class, 'mostrar']);
Route::post('/sesiones/login', [ClientesLoginController::class, 'login']);
Route::post('/logout', [ClientesLoginController::class, 'logout']);