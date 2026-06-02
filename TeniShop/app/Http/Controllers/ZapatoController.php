<?php
namespace App\Http\Controllers;

use App\Models\Zapato;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;

class ZapatoController extends Controller
{
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

        return response()->json([
            'zapato'      => $zapato,
            'relacionados'=> $relacionados,
        ]);
    }

    public function buscar(Request $request)
    {
        $q = $request->input('q', '');

        $zapatos = Zapato::with(['categoria', 'marca', 'tallas'])
            ->when($q, fn($query) => $query->buscar($q))
            ->paginate(8)
            ->withQueryString();

        return response()->json([
            'zapatos' => $zapatos,
            'q'       => $q,
        ]);
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

        return response()->json([
            'zapatos'    => $zapatos,
            'categorias' => $categorias,
        ]);
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
            'imagen_principal'=> 'nullable',
            'disponible'      => 'boolean',
            'tallas'              => 'nullable|array',
            'tallas.*.talla_us'   => 'required|numeric',
            'tallas.*.talla_eu'   => 'required|numeric',
            'tallas.*.stock'      => 'required|integer|min:0',
            'imagenes'        => 'nullable|array',
            'imagenes.*'      => 'image|max:2048',
        ]);

        $zapato = Zapato::create($validated);

        if ($request->filled('tallas')) {
            foreach ($request->tallas as $talla) {
                $zapato->tallas()->create($talla);
            }
        }

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $orden => $archivo) {
                $zapato->imagenes()->create([
                    'url'   => $archivo->store('zapatos/galeria', 'public'),
                    'orden' => $orden,
                ]);
            }
        }

        return response()->json([
            'message' => 'Zapato creado correctamente.',
            'zapato'  => $zapato->load(['tallas', 'imagenes']),
        ], 201);
    }

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
            'imagen_principal'=> 'nullable|string|max:500',
            'disponible'      => 'boolean',
        ]);

        if (empty($validated['imagen_principal'])) {
            unset($validated['imagen_principal']);
        }

        $zapato->update($validated);

        return response()->json([
            'message' => 'Zapato actualizado.',
            'zapato'  => $zapato,
        ]);
    }

    public function destroy(Zapato $zapato)
    {
        $zapato->delete();

        return response()->json([
            'message' => 'Zapato eliminado.',
        ]);
    }
}