<?php
namespace App\Http\Controllers;

use App\Models\Zapato;
use App\Models\ImagenZapato;
use Illuminate\Http\Request;

class ImagenZapatoController extends Controller
{
    public function store(Request $request, Zapato $zapato)
    {
        $request->validate([
            'imagenes'   => 'required|array|min:1',
            'imagenes.*' => 'image|max:2048',
        ]);

        $ultimoOrden = $zapato->imagenes()->max('orden') ?? -1;
        $guardadas = [];

        foreach ($request->file('imagenes') as $archivo) {
            $ultimoOrden++;
            $guardadas[] = $zapato->imagenes()->create([
                'url'   => $archivo->store('zapatos/galeria', 'public'),
                'orden' => $ultimoOrden,
            ]);
        }

        return response()->json([
            'message'  => 'Imágenes agregadas.',
            'imagenes' => $guardadas,
        ], 201);
    }

    public function update(Request $request, ImagenZapato $imagen)
    {
        $request->validate([
            'orden' => 'required|integer|min:0',
        ]);

        $imagen->update(['orden' => $request->orden]);

        return response()->json([
            'message' => 'Orden actualizado.',
            'imagen'  => $imagen,
        ]);
    }

    public function destroy(ImagenZapato $imagen)
    {
        $imagen->delete();

        return response()->json([
            'message' => 'Imagen eliminada.',
        ]);
    }
}