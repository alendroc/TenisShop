<?php
namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::withCount('zapatos')
            ->orderBy('nombre')
            ->paginate(10);

        return response()->json($marcas);
    }

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

        $marca = Marca::create($validated);

        return response()->json([
            'message' => 'Marca creada correctamente.',
            'marca'   => $marca,
        ], 201);
    }

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

        return response()->json([
            'message' => 'Marca actualizada.',
            'marca'   => $marca,
        ]);
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();

        return response()->json([
            'message' => 'Marca eliminada.',
        ]);
    }
}