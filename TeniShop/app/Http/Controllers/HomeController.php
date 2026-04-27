<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Zapato;

class HomeController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount('zapatos')->get();

        $destacados = Zapato::with(['categoria', 'marca'])
            ->disponible()
            ->take(8)
            ->get();

        return view('home', compact('categorias', 'destacados'));
    }
}