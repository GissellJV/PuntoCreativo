<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
       //

    }

    public function create()
    {
        return view('crear-servicio');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'required|image|max:2048',
        ], [
            'nombre.required' => 'El nombre del servicio es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.required' => 'La imagen es obligatoria.',
            'imagen.uploaded' => 'La imagen no pudo subirse. Verifique que no supere los 2 MB.',
            'imagen.max' => 'La imagen no debe ser mayor a 2 MB.',
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')
                ->store('servicios', 'public');
        }

        Servicio::create($datos);

        return redirect()
            ->route('servicios.create')
            ->with('success', 'Servicio registrado correctamente.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
