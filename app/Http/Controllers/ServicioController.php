<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $query = Servicio::query();

        if ($request->filled('buscar')) {
            $query->where(function ($consulta) use ($request) {
                $consulta->where('nombre', 'like', '%'.$request->buscar.'%')
                    ->orWhere('categoria', 'like', '%'.$request->buscar.'%');
            });
        }

        if ($request->filled('categoria')) {
            $query->whereIn('categoria', $request->categoria);
        }
        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        if ($request->filled('orden')) {
            if ($request->orden == 'precio_asc') {
                $query->orderBy('precio', 'asc');
            } elseif ($request->orden == 'precio_desc') {
                $query->orderBy('precio', 'desc');
            } elseif ($request->orden == 'popular') {
                $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $servicios = $query
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('catalogo', compact('servicios'));
    }

    public function create()
    {
        return view('crear-servicio');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'categoria' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'imagen_principal' => 'required|image|max:2048',
            'imagen1' => 'required|image|max:2048',
            'imagen2' => 'required|image|max:2048',
            'imagen3' => 'nullable|image|max:2048',
            'imagen4' => 'nullable|image|max:2048',

        ], [
            'categoria.required' => 'La categoria del servicio es obligatoria.',
            'nombre.required' => 'El nombre del servicio es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',

            'imagen_principal.image' => 'El archivo debe ser una imagen.',
            'imagen_principal.required' => 'La imagen es obligatoria.',
            'imagen_principal.uploaded' => 'La imagen no pudo subirse. Verifique que no supere los 2 MB.',
            'imagen_principal.max' => 'La imagen no debe ser mayor a 2 MB.',

            'imagen1.image' => 'El archivo debe ser una imagen.',
            'imagen1.required' => 'La imagen es obligatoria.',
            'imagen1.uploaded' => 'La imagen no pudo subirse. Verifique que no supere los 2 MB.',
            'imagen1.max' => 'La imagen no debe ser mayor a 2 MB.',

            'imagen2.image' => 'El archivo debe ser una imagen.',
            'imagen2.required' => 'La imagen es obligatoria.',
            'imagen2.uploaded' => 'La imagen no pudo subirse. Verifique que no supere los 2 MB.',
            'imagen2.max' => 'La imagen no debe ser mayor a 2 MB.',

            'imagen3.image' => 'El archivo debe ser una imagen.',
            'imagen3.uploaded' => 'La imagen no pudo subirse. Verifique que no supere los 2 MB.',
            'imagen3.max' => 'La imagen no debe ser mayor a 2 MB.',

            'imagen4.image' => 'El archivo debe ser una imagen.',
            'imagen4.uploaded' => 'La imagen no pudo subirse. Verifique que no supere los 2 MB.',
            'imagen4.max' => 'La imagen no debe ser mayor a 2 MB.',
        ]);

        $imagenes = [
            'imagen_principal',
            'imagen1',
            'imagen2',
            'imagen3',
            'imagen4',
        ];

        foreach ($imagenes as $imagen) {
            if ($request->hasFile($imagen)) {
                $datos[$imagen] = $request->file($imagen)
                    ->store('servicios', 'public');
            }
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
        $servicio = Servicio::findOrFail($id);

        $relacionados = Servicio::where('categoria', $servicio->categoria)
            ->where('id', '!=', $servicio->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('producto', compact('servicio', 'relacionados'));
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
