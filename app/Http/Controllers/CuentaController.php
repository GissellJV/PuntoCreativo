<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class CuentaController extends Controller
{
    public function index(Request $request): View
    {
        $pedidos = $request->user()
            ->pedidos()
            ->with('detalles')
            ->latest()
            ->paginate(2)
            ->withQueryString();

        return view(
            'cuenta',
            compact('pedidos')
        );
    }

    public function actualizarPerfil(
        Request $request
    ): RedirectResponse {
        $datos = $request->validateWithBag('perfil', [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser válido.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
        ]);

        $request->user()->update([
            'name' => $datos['name'],
        ]);

        return back()->with(
            'success',
            'Tu nombre se actualizó correctamente.'
        );
    }

    public function actualizarPassword(
        Request $request
    ): RedirectResponse {
        $datos = $request->validateWithBag('password', [
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ], [
            'current_password.required' =>
                'Debes ingresar tu contraseña actual.',

            'current_password.current_password' =>
                'La contraseña actual es incorrecta.',

            'password.required' =>
                'Debes ingresar una nueva contraseña.',

            'password.confirmed' =>
                'Las nuevas contraseñas no coinciden.',

            'password.min' =>
                'La contraseña debe tener al menos 8 caracteres.',
        ]);

        $request->user()->update([
            'password' => Hash::make($datos['password']),
        ]);

        $request->session()->regenerate();

        return back()->with(
            'success',
            'Tu contraseña se actualizó correctamente.'
        );
    }
}
