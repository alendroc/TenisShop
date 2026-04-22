<?php

namespace App\Http\Controllers;

use App\Models\Zapato;
use App\Models\ImagenZapato;
use Illuminate\Http\Request;

class ImagenZapatoController extends Controller
{
    /**
     * Agrega imágenes a un zapato.
     * Ruta: POST /admin/zapatos/{zapato}/imagenes
     */
    public function store(Request $request, Zapato $zapato)
    {
        $request->validate([
            'imagenes'   => 'required|array|min:1',
            'imagenes.*' => 'image|max:2048',
        ]);

        $ultimoOrden = $zapato->imagenes()->max('orden') ?? -1;

        foreach ($request->file('imagenes') as $archivo) {
            $ultimoOrden++;
            $zapato->imagenes()->create([
                'url'   => $archivo->store('zapatos/galeria', 'public'),
                'orden' => $ultimoOrden,
            ]);
        }

        return back()->with('success', 'Imágenes agregadas.');
    }

    /**
     * Actualiza el orden de una imagen.
     * Ruta: PUT /admin/imagenes/{imagen}
     */
    public function update(Request $request, ImagenZapato $imagen)
    {
        $request->validate([
            'orden' => 'required|integer|min:0',
        ]);

        $imagen->update(['orden' => $request->orden]);

        return back()->with('success', 'Orden actualizado.');
    }

    /**
     * Elimina una imagen.
     * Ruta: DELETE /admin/imagenes/{imagen}
     */
    public function destroy(ImagenZapato $imagen)
    {
        $imagen->delete();

        return back()->with('success', 'Imagen eliminada.');
    }
}