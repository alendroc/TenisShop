<?php

namespace App\Http\Controllers;

use App\Models\Zapato;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\ImagenZapato;
use App\Models\TallaZapato;
use Illuminate\Http\Request;

class ZapatoController extends Controller
{
    /**
     * Detalle público de un zapato.
     * Ruta: GET /productos/{zapato}
     */
    public function show(Zapato $zapato)
    {
        $zapato->load([
            'categoria',
            'marca',
            'imagenes',
            'tallas' => fn($q) => $q->orderBy('talla_us'),
        ]);

        $relacionados = Zapato::where('categoria_id', $zapato->categoria_id)
            ->where('id', '!=', $zapato->id)
            ->disponible()
            ->with(['marca', 'tallas'])
            ->take(4)
            ->get();

        return view('productos.show', compact('zapato', 'relacionados'));
    }

    /**
     * Búsqueda global con paginación.
     * Ruta: GET /buscar
     */
    public function buscar(Request $request)
    {
        $q = $request->input('q', '');

        $zapatos = Zapato::with(['categoria', 'marca', 'tallas'])
            ->when($q, fn($query) => $query->buscar($q))
            ->paginate(8)
            ->withQueryString();

        return view('productos.buscar', compact('zapatos', 'q'));
    }

public function adminIndex(Request $request)
{
    $zapatos = Zapato::with(['categoria', 'marca'])
        ->when($request->filled('q'), fn($q) => $q->buscar($request->q))
        ->when($request->filled('categoria'), fn($q) =>
            $q->where('categoria_id', $request->categoria)
        )
        ->orderBy('nombre')
        ->paginate(15)
        ->withQueryString();

    $categorias = Categoria::orderBy('nombre')->get();

    return view('admin.zapatos.index', compact('zapatos', 'categorias'));
}

// Para el público — GET /buscar o lo que necesites
public function index(Request $request)
{

    return redirect()->route('home');
}

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        $marcas     = Marca::orderBy('nombre')->get();

        return view('admin.zapatos.create', compact('categorias', 'marcas'));
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categoria_id'    => 'required|exists:categorias,id',
            'marca_id'        => 'required|exists:marcas,id',
            'nombre'          => 'required|string|max:150',
            'descripcion'     => 'nullable|string',
            'precio'          => 'required|numeric|min:0',
            'estilo'          => 'nullable|string|max:80',
            'material'        => 'nullable|string|max:80',
            'color_principal' => 'nullable|string|max:80',
            'imagen_principal'=> 'nullable|image|max:2048',
            'disponible'      => 'boolean',

            // Tallas
            'tallas'              => 'nullable|array',
            'tallas.*.talla_us'   => 'required|numeric',
            'tallas.*.talla_eu'   => 'required|numeric',
            'tallas.*.stock'      => 'required|integer|min:0',

            // Imágenes adicionales
            'imagenes'        => 'nullable|array',
            'imagenes.*'      => 'image|max:2048',
        ]);

        // Imagen principal
        if ($request->hasFile('imagen_principal')) {
            $validated['imagen_principal'] = $request->file('imagen_principal')
                ->store('zapatos', 'public');
        }

        $zapato = Zapato::create($validated);

        // Guardar tallas
        if ($request->filled('tallas')) {
            foreach ($request->tallas as $talla) {
                $zapato->tallas()->create($talla);
            }
        }

        // Guardar imágenes adicionales
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $orden => $archivo) {
                $zapato->imagenes()->create([
                    'url'   => $archivo->store('zapatos/galeria', 'public'),
                    'orden' => $orden,
                ]);
            }
        }

        return redirect()->route('admin.zapatos.index')
            ->with('success', 'Zapato creado correctamente.');
    }

    /**
     * Formulario para editar zapato.
     * Ruta: GET /admin/zapatos/{zapato}/edit
     */
    public function edit(Zapato $zapato)
    {
        $zapato->load(['tallas', 'imagenes']);
        $categorias = Categoria::orderBy('nombre')->get();
        $marcas     = Marca::orderBy('nombre')->get();

        return view('admin.zapatos.edit', compact('zapato', 'categorias', 'marcas'));
    }

    /**
     * Actualiza un zapato.
     * Ruta: PUT /admin/zapatos/{zapato}
     */
    public function update(Request $request, Zapato $zapato)
    {
        $validated = $request->validate([
            'categoria_id'    => 'required|exists:categorias,id',
            'marca_id'        => 'required|exists:marcas,id',
            'nombre'          => 'required|string|max:150',
            'descripcion'     => 'nullable|string',
            'precio'          => 'required|numeric|min:0',
            'estilo'          => 'nullable|string|max:80',
            'material'        => 'nullable|string|max:80',
            'color_principal' => 'nullable|string|max:80',
            'imagen_principal'=> 'nullable|image|max:2048',
            'disponible'      => 'boolean',
        ]);

        if ($request->hasFile('imagen_principal')) {
            $validated['imagen_principal'] = $request->file('imagen_principal')
                ->store('zapatos', 'public');
        }

        $zapato->update($validated);

        return redirect()->route('admin.zapatos.index')
            ->with('success', 'Zapato actualizado.');
    }

    /**
     * Elimina un zapato (cascade elimina tallas e imágenes).
     * Ruta: DELETE /admin/zapatos/{zapato}
     */
    public function destroy(Zapato $zapato)
    {
        $zapato->delete();

        return redirect()->route('admin.zapatos.index')
            ->with('success', 'Zapato eliminado.');
    }
}