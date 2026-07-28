<?php

use Illuminate\Support\Facades\Route;

// Página principal / tienda
Route::get('/', function () {
    return view('index');
})->name('index');

// Catálogo de productos
Route::get('/catalogo', function () {
    return view('catalogo');
})->name('catalogo');

// Detalle de producto
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
Route::get('/sitemap', function () {
    return view('sitemap');
})->name('sitemap');
