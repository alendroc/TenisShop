<?php
namespace App\Http\Controllers;

use App\Models\Zapato;
use App\Models\TallaZapato;
use Illuminate\Http\Request;

class TallaZapatoController extends Controller
{
    public function store(Request $request, Zapato $zapato)
    {
        $validated = $request->validate([
            'talla_us' => 'required|numeric|min:1|max:20',
            'talla_eu' => 'required|numeric|min:30|max:60',
            'stock'    => 'required|integer|min:0',
        ]);

        $talla = $zapato->tallas()->create($validated);

        return response()->json([
            'message' => 'Talla agregada.',
            'talla'   => $talla,
        ], 201);
    }

    public function update(Request $request, TallaZapato $talla)
    {
        $validated = $request->validate([
            'talla_us' => 'required|numeric|min:1|max:20',
            'talla_eu' => 'required|numeric|min:30|max:60',
            'stock'    => 'required|integer|min:0',
        ]);

        $talla->update($validated);

        return response()->json([
            'message' => 'Talla actualizada.',
            'talla'   => $talla,
        ]);
    }

    public function destroy(TallaZapato $talla)
    {
        $talla->delete();

        return response()->json([
            'message' => 'Talla eliminada.',
        ]);
    }
}