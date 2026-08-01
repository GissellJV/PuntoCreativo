<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function registrarse(Request $request)
    {
        $datos = $request->validateWithBag('registro', [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $usuario = User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['password']),
        ]);

        Auth::login($usuario);

        $request->session()->regenerate();

        return redirect()
            ->route('cuenta')
            ->with('success', 'Cuenta creada correctamente.');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validateWithBag('inicioSesion', [
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if (! Auth::attempt($credenciales, $request->boolean('remember'))) {
            return back()
                ->withErrors([
                    'credenciales' => 'El correo o la contraseña son incorrectos.',
                ], 'inicioSesion')
                ->withInput($request->only('email'))
                ->with('open_auth_modal', 'login');
        }

        $request->session()->regenerate();

        return redirect()
            ->route('cuenta')
            ->with('success', 'Sesión iniciada correctamente.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('index')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}
