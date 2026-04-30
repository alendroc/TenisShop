<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Zapato;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Lista todas las categorías con conteo de zapatos.
     * Ruta: GET /categorias
     */
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

        return view('categorias.index', compact('categorias', 'destacados'));
    }

    /**
     * Muestra los zapatos de una categoría con búsqueda, orden y paginación.
     * Ruta: GET /categorias/{categoria}
     */
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

        return view('categorias.show', compact('categoria', 'zapatos'));
    }

    // ── CRUD (para panel admin) ──────────────────────────

    /**
     * Formulario para crear categoría.
     * Ruta: GET /admin/categorias/create
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Guarda una nueva categoría.
     * Ruta: POST /admin/categorias
     */
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

        Categoria::create($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Formulario para editar categoría.
     * Ruta: GET /admin/categorias/{categoria}/edit
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Actualiza una categoría.
     * Ruta: PUT /admin/categorias/{categoria}
     */
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

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada.');
    }

    /**
     * Elimina una categoría.
     * Ruta: DELETE /admin/categorias/{categoria}
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada.');
    }
}