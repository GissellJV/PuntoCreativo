<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\PedidoController;

// Página principal / tienda
Route::get('/', function () {
    return view('index');
})->name('index');

// Catálogo de productos
Route::get('/catalogo', [ServicioController::class, 'index'])
    ->name('catalogo');

// Mostrar formulario para registrar un servicio
Route::get('/servicios/create-puntoCreativo26', [ServicioController::class, 'create'])
    ->name('servicios.create');

// Guardar el servicio
Route::post('/servicios', [ServicioController::class, 'store'])
    ->name('servicios.store');

// Detalle de producto
Route::get('/servicio/{id}', [ServicioController::class, 'show'])
    ->name('servicio.detalle');

Route::get('/producto', function () {
    return view('producto');
})->name('producto');

// Carrito de compras
Route::get('/carrito', function () {
    return view('carrito');
})->name('carrito');

// Checkout / finalizar compra
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::post(
    '/pedidos',
    [PedidoController::class, 'store']
)->name('pedidos.store');

// Confirmación de compra
Route::get('/confirmacion', function () {
    return view('confirmacion');
})->name('confirmacion');


/*Route::get('/cuenta', function () {
    return view('cuenta');
})->name('cuenta');
*/

// paypal
Route::post(
    '/paypal/orders',
    [PayPalController::class, 'createOrder']
)->name('paypal.orders.create');

Route::post(
    '/paypal/orders/{orderId}/capture',
    [PayPalController::class, 'captureOrder']
)->name('paypal.orders.capture');

// Políticas de privacidad
Route::get('/privacidad', function () {
    return view('privacidad');
})->name('privacidad');

// Política de cookies
Route::get('/cookies', function () {
    return view('cookies');
})->name('cookies');

// Términos y condiciones
Route::get('/terminos', function () {
    return view('terminos');
})->name('terminos');

// Mapa del sitio
Route::get('/sistemap', function () {
    return view('sistemap');
})->name('sistemap');

// Cuenta del usuario
Route::get('/cuenta', function () {
    return view('cuenta');
})->middleware('auth')->name('cuenta');


// Iniciar sesión
Route::post('/iniciar-sesion', [LoginController::class, 'login'])
    ->name('usuario.login');

// Registrar usuario
Route::post('/registrarse', [LoginController::class, 'registrarse'])
    ->name('usuario.registrarse');
// Cerrar sesión
Route::post('/cerrar-sesion', [LoginController::class, 'logout'])
    ->name('usuario.logout');

Route::middleware('auth')->group(function () {
    Route::get(
        '/cuenta',
        [CuentaController::class, 'index']
    )->name('cuenta');

    Route::put(
        '/cuenta/perfil',
        [CuentaController::class, 'actualizarPerfil']
    )->name('cuenta.perfil.actualizar');

    Route::put(
        '/cuenta/password',
        [CuentaController::class, 'actualizarPassword']
    )->name('cuenta.password.actualizar');
});
