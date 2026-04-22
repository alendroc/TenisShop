<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Lista todas las marcas.
     * Ruta: GET /admin/marcas
     */
    public function index()
    {
        $marcas = Marca::withCount('zapatos')
            ->orderBy('nombre')
            ->paginate(10);

        return view('admin.marcas.index', compact('marcas'));
    }

    /**
     * Formulario para crear marca.
     * Ruta: GET /admin/marcas/create
     */
    public function create()
    {
        return view('admin.marcas.create');
    }

    /**
     * Guarda una nueva marca.
     * Ruta: POST /admin/marcas
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100|unique:marcas,nombre',
            'pais_origen' => 'nullable|string|max:100',
            'logo'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('marcas', 'public');
        }

        Marca::create($validated);

        return redirect()->route('admin.marcas.index')
            ->with('success', 'Marca creada correctamente.');
    }

    /**
     * Formulario para editar marca.
     * Ruta: GET /admin/marcas/{marca}/edit
     */
    public function edit(Marca $marca)
    {
        return view('admin.marcas.edit', compact('marca'));
    }

    /**
     * Actualiza una marca.
     * Ruta: PUT /admin/marcas/{marca}
     */
    public function update(Request $request, Marca $marca)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100|unique:marcas,nombre,' . $marca->id,
            'pais_origen' => 'nullable|string|max:100',
            'logo'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('marcas', 'public');
        }

        $marca->update($validated);

        return redirect()->route('admin.marcas.index')
            ->with('success', 'Marca actualizada.');
    }

    /**
     * Elimina una marca.
     * Ruta: DELETE /admin/marcas/{marca}
     */
    public function destroy(Marca $marca)
    {
        $marca->delete();

        return redirect()->route('admin.marcas.index')
            ->with('success', 'Marca eliminada.');
    }
}