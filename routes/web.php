<?php

use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;

// Página principal / tienda
Route::get('/', function () {
    return view('index');
})->name('index');

// Catálogo de productos
Route::get('/catalogo', [ServicioController::class, 'index'])
    ->name('catalogo');

// Mostrar formulario para registrar un servicio
Route::get('/servicios/create', [ServicioController::class, 'create'])
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

// Confirmación de compra
Route::get('/confirmacion', function () {
    return view('confirmacion');
})->name('confirmacion');

// Cuenta del usuario
Route::get('/cuenta', function () {
    return view('cuenta');
})->name('cuenta');

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
