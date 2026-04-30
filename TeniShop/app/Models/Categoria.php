<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'genero',
        'imagen',
    ];

    // ── Relaciones ──────────────────────────────────────

    /** Una categoría clasifica muchos zapatos */
    public function zapatos()
    {
        return $this->hasMany(Zapato::class);
    }

    // ── Scopes ──────────────────────────────────────────

    /** Filtra categorías por género: Hombre, Mujer, Niño, Unisex */
    public function scopePorGenero(Builder $query, string $genero): Builder
    {
        return $query->where('genero', $genero);
    }
}