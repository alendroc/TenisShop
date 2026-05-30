<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Zapato;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::withCount('zapatos')
            ->when($request->filled('genero'), fn($q) =>
                $q->porGenero($request->genero)
            )
            ->orderBy('nombre')
            ->get();

        $destacados = Zapato::disponible()
            ->with(['categoria', 'marca'])
            ->latest()
            ->take(4)
            ->get();

        return response()->json([
            'categorias' => $categorias,
            'destacados' => $destacados,
        ]);
    }

    public function show(Request $request, Categoria $categoria)
    {
        $query = $categoria->zapatos()
            ->with(['marca', 'tallas', 'imagenes']);

        if ($request->filled('q')) {
            $query->buscar($request->q);
        }

        match ($request->orden) {
            'precio_asc'  => $query->orderBy('precio', 'asc'),
            'precio_desc' => $query->orderBy('precio', 'desc'),
            'nombre_asc'  => $query->orderBy('nombre', 'asc'),
            default       => $query->orderBy('id', 'asc'),
        };

        $zapatos = $query->paginate(8)->withQueryString();

        return response()->json([
            'categoria' => $categoria,
            'zapatos'   => $zapatos,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'genero'      => 'required|in:Hombre,Mujer,Niño,Unisex',
            'imagen'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('categorias', 'public');
        }

        $categoria = Categoria::create($validated);

        return response()->json([
            'message'   => 'Categoría creada correctamente.',
            'categoria' => $categoria,
        ], 201);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'genero'      => 'required|in:Hombre,Mujer,Niño,Unisex',
            'imagen'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('categorias', 'public');
        }

        $categoria->update($validated);

        return response()->json([
            'message'   => 'Categoría actualizada.',
            'categoria' => $categoria,
        ]);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response()->json([
            'message' => 'Categoría eliminada.',
        ]);
    }
}