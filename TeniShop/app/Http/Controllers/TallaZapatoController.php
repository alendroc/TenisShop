<?php

namespace App\Http\Controllers;

use App\Models\Zapato;
use App\Models\TallaZapato;
use Illuminate\Http\Request;

class TallaZapatoController extends Controller
{
    /**
     * Agrega una talla a un zapato.
     * Ruta: POST /admin/zapatos/{zapato}/tallas
     */
    public function store(Request $request, Zapato $zapato)
    {
        $validated = $request->validate([
            'talla_us' => 'required|numeric|min:1|max:20',
            'talla_eu' => 'required|numeric|min:30|max:60',
            'stock'    => 'required|integer|min:0',
        ]);

        $zapato->tallas()->create($validated);

        return back()->with('success', 'Talla agregada.');
    }

    /**
     * Actualiza el stock de una talla.
     * Ruta: PUT /admin/tallas/{talla}
     */
    public function update(Request $request, TallaZapato $talla)
    {
        $validated = $request->validate([
            'talla_us' => 'required|numeric|min:1|max:20',
            'talla_eu' => 'required|numeric|min:30|max:60',
            'stock'    => 'required|integer|min:0',
        ]);

        $talla->update($validated);

        return back()->with('success', 'Talla actualizada.');
    }

    /**
     * Elimina una talla.
     * Ruta: DELETE /admin/tallas/{talla}
     */
    public function destroy(TallaZapato $talla)
    {
        $talla->delete();

        return back()->with('success', 'Talla eliminada.');
    }
}